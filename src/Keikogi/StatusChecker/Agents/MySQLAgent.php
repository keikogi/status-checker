<?php

namespace Keikogi\StatusChecker\Agents;

use Keikogi\StatusChecker\Interfaces\AgentInterface;

class MySQLAgent implements AgentInterface
{
    private $user;

    private $password;

    private $database;

    private $host;

    private $db;

    public function __construct($data)
    {
        try {
            $this->user = $data['user'];
            $this->password = $data['password'];
            $this->database = $data['database'];
            $this->host = $data['host'];

            $this->db = new \PDO(
                'mysql:host=' . $this->host . ';dbname=' . $this->database,
                $this->user,
                $this->password
            );
        } catch (\PDOException $e) {
            return false;
        }
    }

    public function getCoreLogItem($service)
    {
        $message = $this->db->prepare(
            "SELECT * FROM core_log WHERE service = :service ORDER BY id DESC LIMIT 1"
        );

        $message->execute(
            array(
                ':service' => $service
            )
        );

        return $message->fetch();
    }

    public function addCoreLogItem($service, $code, $message)
    {
        if (is_null($message)) {
            $message = 'NA';
        }

        try {
            $q = $this->db->prepare(
                "INSERT INTO core_log VALUES (NULL, :time, :service, :code, :message, '')"
            );

            $q->execute(
                array(
                    ':time' => date('Y-m-d H:i:s'),
                    ':service' => $service,
                    ':code' => $code,
                    ':message' => $message
                )
            );

            return true;
        } catch (\PDOExecption $e) {
            return false;
        }
    }

    public function addNotifyLogItem($service, $notify, $contact, $message)
    {
        if (is_null($message)) {
            $message = 'NA';
        }

        try {
            $q = $this->db->prepare(
                "INSERT INTO notify_log VALUES (NULL, :time, :service, :notify, :contact, :message)"
            );

            $q->execute(
                array(
                    ':time' => date('Y-m-d H:i:s'),
                    ':service' => $service,
                    ':notify' => $notify,
                    ':contact' => $contact,
                    ':message' => $message,
                )
            );

            return true;
        } catch (\PDOExecption $e) {
            return false;
        }
    }
}
