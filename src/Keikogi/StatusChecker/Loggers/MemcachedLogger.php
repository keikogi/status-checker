<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class MemcachedLogger extends ServiceLogger
{
    public function getName()
    {
        return 'memcached';
    }
}
