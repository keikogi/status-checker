<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class TransmissionLogger extends ServiceLogger
{
    public function getName()
    {
        return 'transmission';
    }
}
