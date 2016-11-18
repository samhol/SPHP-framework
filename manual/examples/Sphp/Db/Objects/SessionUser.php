<?php

namespace Sphp\Db\Objects;

use Sphp\Db\EntityManagerFactory;
use Sphp\Core\Security\Password;

$em = EntityManagerFactory::get();


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
  var_dump($users->insertAsNew($john));
  echo "\n$john";
}
return $john;
?>