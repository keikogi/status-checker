<?php

namespace Keikogi\StatusChecker\Notify;

use Keikogi\StatusChecker\Notify\BaseNotify;
use Keikogi\StatusChecker\Interfaces\NotifyInterface;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Request;

class TelegramNotify extends BaseNotify implements NotifyInterface
{
    const TOKEN = '112162978:AAEAQg5rL9EGZjMmwSiFrlhlP6qnmLn8f9s';

    const BOT_NAME = 'KeikogiBot';

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

            $data = array(
                'chat_id' => $contact,
                'text' => $this->protectedMessage,
            );

            Request::send('sendMessage', $data);
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
        $this->sender = new Telegram(self::TOKEN, self::BOT_NAME);

        Request::initialize($this->sender);
    }

    public function getName()
    {
        return 'telegram';
    }
}
