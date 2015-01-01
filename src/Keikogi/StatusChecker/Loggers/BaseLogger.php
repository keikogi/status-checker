<?php

namespace Keikogi\StatusChecker\Loggers;

class BaseLogger
{
    protected $agent;

    protected $added;

    public function __construct($agent)
    {
        $this->agent = $agent;
        $this->NonAdd();
    }

    public function getAgent()
    {
        return $this->agent;
    }

    public function isChanged($code)
    {
        $message = $this->getAgent()->getCoreLogItem($this->getName());
        if (is_null($message) || $message['code'] <> $code) {
            return true;
        }
    }

    public function NonAdd()
    {
        $this->added = false;
    }

    public function YesAdd()
    {
        $this->added = true;
    }

    public function isAdd()
    {
        return $this->added;
    }
}
