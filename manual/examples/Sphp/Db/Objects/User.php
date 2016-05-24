<?php

namespace Sphp\Db\Objects;

$em = include 'entityManager.php';
$johnData = [
    "username" => "johndoe",
    "fname" => "John",
    "lname" => "Doe",
    "email" => "john.doe@unknown.com",
    "phonenumbers" => ["+61 51 345 6789", "+61 51 7010 5678"],
    "street" => "12 Unknown st.",
    "zipcode" => "20720",
    "city" => "Canberra",
    "country" => "Australia",
];
$samiData = [
    "username" => "samhol",
    "fname" => "Sami",
    "lname" => "Holck",
    "email" => "sami.holck@samiholck.com",
    "phonenumbers" => ["+358 44 298 6738"],
    "street" => "Rakuunatie 59 A 3",
    "zipcode" => "20720",
    "city" => "Turku",
    "country" => "Finland",
];
$john = new User($johnData);
echo "John:\n";
print_r($john->toArray());

if ($john->isManagedBy($em)) {
  echo "We have user: $john\n";
} else {
  
}
if ($john->usernameTaken($em)) {
  echo "Username '{$john->getUsername()}' is taken\n";
}
if ($john->existsIn($em)) {
  echo "Similar user exists in the manager\n";
}
/*if ($john->emailTaken($em)) {
  echo "Username {$john->getEmail()} is taken\n";
}*/

return $john;
?>