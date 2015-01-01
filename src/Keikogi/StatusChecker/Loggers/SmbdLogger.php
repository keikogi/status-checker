<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class SmbdLogger extends ServiceLogger
{
    public function getName()
    {
        return 'smbd';
    }
}
