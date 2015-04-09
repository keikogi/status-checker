<?php

namespace Keikogi\StatusChecker\Loggers;

use Keikogi\StatusChecker\Loggers\ServiceLogger;

class OpenVPNLogger extends ServiceLogger
{
    public function getName()
    {
        return 'Openvpn';
    }
}
