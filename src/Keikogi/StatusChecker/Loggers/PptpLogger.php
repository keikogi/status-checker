<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class PptpLogger extends ServiceLogger
{
    public function getName()
    {
        return 'pptpd';
    }
}
