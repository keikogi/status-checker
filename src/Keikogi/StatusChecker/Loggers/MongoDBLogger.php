<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class MongoDBLogger extends ServiceLogger
{
    public function getName()
    {
        return 'mongod';
    }
}
