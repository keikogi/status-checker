<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class PhpFpmLogger extends ServiceLogger
{
    public function getName()
    {
        return 'php5-fpm';
    }
}
