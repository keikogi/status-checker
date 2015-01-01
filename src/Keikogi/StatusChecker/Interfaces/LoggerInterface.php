<?php

namespace Keikogi\StatusChecker\Interfaces;

interface LoggerInterface
{
    public function add($value, $message);

    public function getName();
}
