<?php

namespace Keikogi\StatusChecker\Loggers;

class BaseLogger
{
    protected $agent;

    protected $added;

    public function __construct()
    {
        $this->NonAdd();
    }

    public function setAgent($agent)
    {
        $this->agent = $agent;

        return $this;
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

        return $this;
    }

    public function YesAdd()
    {
        $this->added = true;

        return $this;
    }

    public function isAdd()
    {
        return $this->added;
    }
}
