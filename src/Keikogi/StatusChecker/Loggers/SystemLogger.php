<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\BaseLogger;
use Keikogi\StatusChecker\Interfaces\LoggerInterface;

class SystemLogger extends BaseLogger implements LoggerInterface
{
    public function add($code, $message = NULL)
    {
        $this->NonAdd();

        $isChanged = $this->isChanged($code);

        if (!$this->getAgent()->addCoreLogItem($this->getName(), $code, $message)) {
            return false;
        }

        if (!$isChanged) {
            return false;
        }

        $this->YesAdd();

        return true;
    }

    public function getName()
    {
        return 'system';
    }
}
