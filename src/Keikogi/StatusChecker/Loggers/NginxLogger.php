<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class NginxLogger extends ServiceLogger
{
    public function getName()
    {
        return 'nginx';
    }
}
