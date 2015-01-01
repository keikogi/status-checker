<?php

namespace Keikogi\StatusChecker\Interfaces;

interface AgentInterface
{
    public function getCoreLogItem($service);

    public function addCoreLogItem($service, $code, $message);

    public function addNotifyLogItem($service, $notify, $contact, $message);
}
