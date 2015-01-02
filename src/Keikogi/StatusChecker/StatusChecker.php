<?php

namespace Keikogi\StatusChecker;

class StatusChecker
{
    const VERSION = '1.0';

    const API_URL = 'http://api.keikogi.ru/index.php';

    const USER_AGENT = 'cURL/%s (KeikogiStatusChecker/%s; RequestID/%d; http://status.keikogi.ru)';

    const NUM_REQUESTS = 3;

    private $curl;

    private $code;

    private $agent;

    private $message;

    private $version;

    private $notifyList;

    private $loggerList;

    public function __construct($agent, $loggerList = array(), $notifyList = array())
    {
        $this->agent = $agent;
        $this->notifyList = $notifyList;
        $this->loggerList = $loggerList;

        $this->curl = curl_init();
        $this->version = curl_version();

        curl_setopt_array(
            $this->curl,
            array(
                CURLOPT_CONNECTTIMEOUT => 2,
                CURLOPT_TIMEOUT => 5,
                CURLOPT_HEADER => FALSE,
                CURLOPT_RETURNTRANSFER => TRUE,
                CURLOPT_URL => self::API_URL
            )
        );
    }

    public function request($number)
    {
        curl_setopt(
            $this->curl,
            CURLOPT_USERAGENT,
            sprintf(
                self::USER_AGENT,
                $this->version['version'],
                self::VERSION,
                $number
            )
        );

        $responseText = curl_exec($this->curl);
        $response = curl_getinfo($this->curl);

        $logData['text'] = $responseText;

        if ($response) {
            foreach ($response as $name => $data) {
                $logData[$name] = is_array($data) ? implode('//', $data) : $data;
            }
        }

        return array(
            'code' => $response['http_code'],
            'message' => json_encode($logData),
        );
    }

    public function run()
    {
        $timer = 0;
        $failCount = 0;
        $goodCount = 0;

        for ($i = 1; $i <= self::NUM_REQUESTS; $i++) {
            $begin = microtime(true);
            $_result = $this->request($i);
            $timer = microtime(true) - $begin;

            if ($_result['code'] == '200') {
                ++$goodCount;
                $lastGoodItem = $_result;
            } else {
                ++$failCount;
                $lastFailItem = $_result;
            }
        }

        if ($failCount >= $goodCount) {
            $this->code = $lastFailItem['code'];
            $this->message = $lastFailItem['message'];
        } else {
            $this->code = $lastGoodItem['code'];
            $this->message = $lastGoodItem['message'];
        }

        if ($this->code == '200') {
            $this->code = 'UP';
        } else {
            $this->code = 'DOWN';
        }

        $this->agent->addTimerLogItem($timer / 3);
        $this->logAnswer();
    }

    public function logAnswer()
    {
        if (!$this->loggerList) {
            return false;
        }

        foreach ($this->loggerList as $logger) {
            $logger
                ->setAgent($this->agent)
                ->add(
                    $this->code,
                    $this->message
                );
            if ($this->notifyList) {
                foreach ($this->notifyList as $notify) {
                    $notify
                        ->init()
                        ->setLogger($logger)
                        ->send();
                }
            }
        }

        return true;
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }
}
