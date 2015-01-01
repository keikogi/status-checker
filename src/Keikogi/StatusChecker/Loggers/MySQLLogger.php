<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class MySQLLogger extends ServiceLogger
{
    public function getName()
    {
        return 'mysqld';
    }
}
