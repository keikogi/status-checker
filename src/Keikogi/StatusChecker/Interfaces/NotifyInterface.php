<?php

namespace Keikogi\StatusChecker\Interfaces;

interface NotifyInterface
{
    public function send();

    public function setSender();

    public function getName();
}
