<?php

namespace Sphp\Core\Security;

include_once('manual/settings.php');

try {
  $login = new Login();
  $args = [
      'username' => \FILTER_SANITIZE_STRING,
      'password' => \FILTER_SANITIZE_STRING
  ];
  $myinputs = filter_input_array(INPUT_POST, $args, true);
  var_dump($login->login($myinputs['username'], $myinputs['password']));
} catch (Exception $ex) {
  var_dump($ex);
}


echo '<pre>';
print_r($_POST);
?>
<form name="login" method="post" action="login.php">
  <input type="text" name="username">
  <input type="text" name="password">
  <input type="submit" name="sessionEvent" value="login">
</form>
<?php
//var_dump($login);

foreach ($login->getMessages() as $t => $m) {
  echo "$t, $m\n";
}

use Sphp\Core\Validators\LoginFormValidator;

$v = new LoginFormValidator();
$v->validate($_POST);

foreach ($v->getErrors() as $t => $m) {
  echo "$t, $m\n";
}