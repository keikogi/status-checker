<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class TestLogger extends ServiceLogger
{
    public function getName()
    {
        return 'test_#' . time();
    }
}
