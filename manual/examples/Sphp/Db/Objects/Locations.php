<?php

namespace Sphp\Db\Objects;

$em = include 'entityManager.php';
$locations = new Locations($em);
echo "All locations:\n";
foreach ($locations as $address) {
  echo "\tlocation: {$address->getName()}\n";
}
echo "All stored locations in Finland:\n";
foreach ($locations->findByProperty('address.city', 'Turku') as $finnishLocation) {
  echo "\taddress: $finnishLocation\n";
}
foreach ($locations->findAllByCountry('Finland') as $finnishLocation) {
  echo "\taddress: $finnishLocation\n";
}
?>
