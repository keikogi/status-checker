<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class CapellaLogger extends ServiceLogger
{
    public function getName()
    {
        return 'capella';
    }
}
