Keikogi Status Checker
======================

Requirements
------------
PHP 5.3+

Installation
------------
Add this to a composer.json file:
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/keikogi/status-checker"
    }
],
"require": {
    "keikogi/status-checker": ">=1.0.0"
}
```

Usage
-----
```php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Keikogi\StatusChecker\StatusChecker;
use Keikogi\StatusChecker\Agents\MySQLAgent;
use Keikogi\StatusChecker\Loggers;
use Keikogi\StatusChecker\Notify;

$contactList = array(
    'mail' => array(
        'keikogi@jidckii.ru',
    ),
);

$agent = new MySQLAgent(
    array(
        'host' => 'localhost',
        'database' => 'db',
        'user' => 'user',
        'password' => ''
    )
);

$loggerList = array(
    new Loggers\SystemLogger(),
);

$notifyList = array(
    new Notify\MailNotify($contactList['mail']),
);

$checker = new StatusChecker(
    $agent,
    $loggerList,
    $notifyList
);

$checker->run();
```
