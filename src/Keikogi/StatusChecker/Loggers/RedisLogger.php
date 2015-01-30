<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class RedisLogger extends ServiceLogger
{
    public function getName()
    {
        return 'redis-server';
    }
}
