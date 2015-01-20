<?php

namespace Keikogi\StatusChecker\Notify;

use Keikogi\StatusChecker\Notify\BaseNotify;
use Keikogi\StatusChecker\Interfaces\NotifyInterface;
use PHPushbullet\PHPushbullet;

class PushNotify extends BaseNotify implements NotifyInterface
{
    const TOKEN = 'v1COw64K4MhzBWODmze73ucoJejMeJuUOsujv2FEzmzwy';

    public function send()
    {
        if (!$this->message || !$this->contactList) {
            return false;
        }

        foreach ($this->contactList as $contact) {
            $this->agent->addNotifyLogItem(
                $this->logger->getName(),
                $this->getName(),
                $contact,
                $this->protectedMessage
            );

            if (!$this->protectedMessage) {
                $this->protectedMessage = 'n/a @' . date('Y-m-d H:i');
            }

            $this->sender
                ->user($contact)
                ->note(
                    self::SIGN . ' ' . ucfirst($this->logger->getName()) . ': ' . $this->message['code'],
                    $this->protectedMessage
                );
        }
    }

    public function processMessage($message)
    {
        $message = json_decode($message['message']);
        $message = $message->text;
        return $message;
    }

    public function setSender()
    {
        $this->sender = new PHPushbullet(self::TOKEN);
    }

    public function getName()
    {
        return 'push';
    }
}
