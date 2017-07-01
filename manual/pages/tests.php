<?php

namespace Sphp\Stdlib;

echo"<pre>";


namespace Sphp\Config\ErrorHandling;

$ed = new ErrorDispatcher();
$ed->addListener(\E_NOTICE, function (int $errno, string $errstr, string $errfile, int $errline) {
  echo "\n\tNotice: " . $errstr;
});
$callout = new \Sphp\Html\Foundation\Sites\Containers\ErrorMessageCallout();
$ed->addListener(\E_ALL, $callout);
$ed->start();

trigger_error('Errors suck badly', E_USER_ERROR);

trigger_error('Warnings suck', E_USER_WARNING);
trigger_error('Deprecated features suck', E_USER_DEPRECATED);
trigger_error('Notes suck, but not so bad', E_USER_NOTICE);
echo $foo;
bdsf;
$options = [
    'salt' => mcrypt_create_iv(22, MCRYPT_DEV_URANDOM),
];
password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options)."\n";
echo"</pre>";
?>

<div class="button-group warning">
  <a class="button">Primary Action</a>
  <button type="button" class="dropdown button arrow-only" data-toggle="example-dropdown-1">
    <span class="show-for-sr">Show menu</span>
  </button>
</div>
<span data-toggle="example-dropdown-1">Hoverable Dropdown</span>
<div class="dropdown-pane" id="example-dropdown-1" data-dropdown data-hover="true" data-hover-pane="true">
  Just some junk that needs to be said. Or not. Your choice.
</div>
