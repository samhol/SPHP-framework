<?php

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Foundation\Sites\Core\CalloutBuilder;

$ed = new ErrorDispatcher();
$ed->addErrorListener(\E_USER_ERROR, function (int $errno, string $errstr, string $errfile, int $errline) {
  echo "<p><b>User Error:</b> $errstr</p>";
}, 1);

$ed->addErrorListener(\E_ALL, new CalloutBuilder(true, true), 3);
$ed->startErrorHandling();
include_once('foobar');
trigger_error('User defined Errors suck badly', E_USER_ERROR);
trigger_error('User warnings suck', E_USER_WARNING);
trigger_error('Deprecated user features suck', E_USER_DEPRECATED);
trigger_error('User defined Notes suck a bit', E_USER_NOTICE);

echo $foo;

$options = [
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
password_hash('foo', PASSWORD_BCRYPT, $options) . "\n";

