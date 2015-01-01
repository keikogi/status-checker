<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class IgmpProxyLogger extends ServiceLogger
{
    public function getName()
    {
        return 'igmpproxy';
    }
}
