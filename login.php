<?php

namespace Sphp\Core\Security;

include_once('manual/settings.php');

try {
  $login = new Login();
  $login->login();
} catch (Exception $ex) {
  var_dump($ex);
}


echo '<pre>';

//var_dump($login);

foreach ($login->getMessages() as $t => $m) {
  echo "$t, $m\n";
}
use Sphp\Core\Validators\LoginValidator;

$v = new LoginValidator();
$v->validate(['username' => '223555tt', 'password' => '4']);

foreach ($v->getErrors() as $t => $m) {
  echo "$t, $m\n";
}