<?php

namespace Sphp\Db;

use Sphp\Objects\User as User;
use Sphp\Objects\Address as Address;

$user = (new User())
        ->setUsername("samhol")
        ->setFname("Sami")
        ->setLname("Holck")
        ->setAddress((new Address())
        ->setStreetaddress("Rakuunatie 59 A 3")
        ->setCity("Turku"));
$insert = (new Insert("Users", $user));

echo $insert . "\n";
?>