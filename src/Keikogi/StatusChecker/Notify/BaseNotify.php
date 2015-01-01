<?php

namespace Keikogi\StatusChecker\Notify;

class BaseNotify
{
    const SIGN = 'Keikogi';

    protected $logger;

    protected $agent;

    protected $sender;

    protected $contactList;

    protected $message;

    protected $protectedMessage;

    public function __construct($contactList)
    {
        $this->init();

        $this->contactList = array_unique($contactList);
    }

    public function init()
    {
        $this->message = false;
        $this->protectedMessage = false;

        $this->setSender();

        return $this;
    }

    public function setLogger($logger)
    {
        $this->logger = $logger;
        $this->agent = $logger->getAgent();

        if ($this->logger->isAdd() || $this->logger->getName() == 'test') {
            $this->message = $this->agent->getCoreLogItem($this->logger->getName());
        }

        if ($this->message) {
            $this->protectedMessage = $this->processMessage($this->message);
        }

        return $this;
    }
}
