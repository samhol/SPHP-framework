<?php

namespace Sphp\Db\Objects;

$em = include 'entityManager.php';
$addresses = new Addresses($em);
echo "All addresses:\n";
foreach ($addresses as $address) {
  echo "\taddress: $address\n";
}
echo "All addresses from Finland:\n";
foreach ($addresses->findAllByCountry("Finland") as $address) {
  echo "\taddress: $address\n";
}
?>