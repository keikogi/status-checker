<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class PostgreSQLLogger extends ServiceLogger
{
    public function getName()
    {
        return 'postgres';
    }
}
