<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\BaseLogger;
use Keikogi\StatusChecker\Interfaces\LoggerInterface;

class ServiceLogger extends BaseLogger implements LoggerInterface
{
    public function add($code, $message = NULL)
    {
        $this->NonAdd();

        if (!$message || $code == 'DOWN') {
            return false;
        }

        $logData = json_decode($message);
        $logData = $logData->text;

        if (strpos($logData, $this->getName()) === false) {
            $code = 'DOWN';
        } else {
            $code = 'UP';
        }

        if (!$this->isChanged($code)) {
            return false;
        }

        $message = json_encode(array('text' => ucfirst($this->getName()) . ' status: ' . $code));

        if (!$this->getAgent()->addCoreLogItem($this->getName(), $code, $message)) {
            return false;
        }

        $this->YesAdd();

        return true;
    }

    public function getName()
    {
        return 'cron';
    }
}
