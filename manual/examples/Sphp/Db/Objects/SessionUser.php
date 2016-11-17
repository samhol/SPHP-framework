<?php

namespace Sphp\Db\Objects;

$em = include 'entityManager.php';

use Sphp\Core\Security\Password;

$users = new SessionUserStorage();
$john = (new SessionUser())
        ->setUsername('johndoe')
        ->setEmail('john.doe@unknown.com');
if ($users->contains($john)) {
  echo "We have user: $john\n";
  echo "Delete John Doe: ";
  var_dump($john->deleteFrom($em));
} else {
  $john->setPermissions(0b100111)
          ->setPassword(Password::fromPassword("password"));
  echo "\nInsert John Doe: ";
  var_dump($users->save($john));
  echo "\n$john";
}
return $john;
?>