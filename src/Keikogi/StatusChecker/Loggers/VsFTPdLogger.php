<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class VsFTPdLogger extends ServiceLogger
{
    public function getName()
    {
        return 'vsftpd';
    }
}
