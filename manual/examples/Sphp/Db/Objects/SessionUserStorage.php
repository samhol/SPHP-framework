<?php

namespace Sphp\Db\Objects;

use Sphp\Db\EntityManagerFactory;
use Exception;

$john = include 'SessionUser.php';

$em = EntityManagerFactory::get();
$users = new SessionUserStorage();
try {
  $foobar = $users->findByProperty('foo', 'bar');
} catch (Exception $ex) {
  echo get_class($ex) . ": " . $ex->getMessage() . "\n";
}
try {
  $samhol = $users->findByProperty('username', 'samhol');
} catch (Exception $ex) {
  echo get_class($ex) . ": " . $ex->getMessage() . "\n";
}
try {
  $samhol1 = $users->findBy(['username' => 'samhol']);
} catch (Exception $ex) {
  echo get_class($ex) . ": " . $ex->getMessage() . "\n";
}
var_dump($samhol == $samhol1);
if ($users->contains($john)) {
  echo "\njohndoe exists";
  $john = $users->findByUsername(['johndoe']);
  echo "\nDelete johndoe: ";
  var_dump($john->deleteFrom($em));
  //var_dump($userView->delete($user));
} else {
  //$john->insertInto($entityManager);
  //echo "Insert John Doe as a new user\n";
  //$john->insert();
}
/* if (!$john->exists()) {
  } else {
  echo "Update John Doe\n";
  $john->update();
  } */
//var_dump($userView->upload($john));
//echo "user: " . $userView[205];
var_dump($users->findByUsername("samhol"));
?>
