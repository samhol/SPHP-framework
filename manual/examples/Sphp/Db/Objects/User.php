<?php

namespace Sphp\Objects;

$em = include 'entityManager.php';

use Sphp\Net\Password as Password;
use Sphp\Db\Objects\User;
use Sphp\Db\Objects\Users;
use Sphp\Db\Objects\Address;

$users = new Users($em);
$john = (new User())
        ->setUsername("johndoe");
if ($users->contains($john)) {
  echo "We have user: $john\n";
  echo "Delete John Doe: ";
  var_dump($john->remove());
} else {
  $john->setFname("John")
          ->setLname("Doe")
          ->setEmail("john.doe@unknown.com")
          ->setAddress((new Address())
                  ->setStreet("901-6470 Mauris St.")
                  ->setZipcode("04689")
                  ->setCity("Canberra")
                  ->setCountry("Australia"))
          ->setPermissions(0b100111)
          ->setPassword(new Password("password"));
  echo "\nInsert John Doe: ";
  var_dump($users->save($john));
  echo "\n$john";
}
if ($users->contains($john)) {
  $john->setPhonenumber("112");
  echo "Update John Doe: ";
  var_dump($john->update());
}
return $john;
?>