<?php

namespace Keikogi\StatusChecker\Notify;

use Keikogi\StatusChecker\Notify\BaseNotify;
use Keikogi\StatusChecker\Interfaces\NotifyInterface;

class MailNotify extends BaseNotify implements NotifyInterface
{
    public function send()
    {
        if (!$this->message || !$this->contactList) {
            return false;
        }

        $headers = array();
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-type: text/html; charset=iso-8859-1';
        $headers[] = 'From: ' . self::SIGN . ' ' . ucfirst($this->logger->getName()) . ' Status <noreply@status.keikogi.ru>';
        $headers = implode("\r\n", $headers);

        foreach ($this->contactList as $contact) {
            $this->agent->addNotifyLogItem(
                $this->logger->getName(),
                $this->getName(),
                $contact,
                $this->protectedMessage
            );

            mail(
                $contact,
                ucfirst($this->logger->getName() . ' message'),
                $this->protectedMessage,
                $headers
            );
        }
    }

    public function processMessage($message)
    {
        $text  = '<h1> ' . self::SIGN . ' ' . $this->logger->getName() . ' message</h1>';
        $text .= '<h2>Status changed to ' . $message['code'] . '</h2>';
        $text .= ucfirst($this->logger->getName()) . ' are ';

        if ($message['code'] == 'UP') {
            $text .= ' up and feeling good.';
        } else {
            $text .= ' down and feeling bad.';
        }

        $text .= '<br><br>With love, ' . self::SIGN . '.';

        return $text;
    }

    public function setSender()
    {
        return false;
    }

    public function getName()
    {
        return 'mail';
    }
}
