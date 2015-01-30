<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class DockerLogger extends ServiceLogger
{
    public function getName()
    {
        return 'docker';
    }
}
