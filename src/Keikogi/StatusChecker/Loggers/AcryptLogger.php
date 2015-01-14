<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class AcryptLogger extends ServiceLogger
{
    public function getName()
    {
        return 'acrypt';
    }
}
