<?php

namespace Sphp\Db\Objects;

$em = include 'entityManager.php';

$hydeparkData = [
    'name' => 'Hyde Park',
    'street' => 'W2 2UH',
    'zipcode' => '12538',
    'city' => 'London',
    'country' => 'UK',
    'maplink' => 'https://goo.gl/maps/ZWHMuHB4sd22'
];
$hydepark = new Location($hydeparkData);
$locationData[] = [
    'name' => 'Pikkukakkosen posti',
    'street' => "PL 347",
    'zipcode' => "33101",
    'city' => 'Tampere',
    'country' => 'Finland',
];


$locations = new LocationStorage();
try {
  $hydepark->insertAsNewInto($em);
} catch (\Exception $ex) {
  echo "Hydepark is already stored into the database\n";
  $hydepark = $locations->findByName($hydepark);
}
$addrs[] = $hydepark;
//$locations->save($hydepark);
$addrs[] = (new Location())
        ->setStreet("Mariankatu 2")
        ->setZipcode("00170")
        ->setCity("Helsinki")
        ->setCountry("Finland");

$addrs[] = (new Location())
        ->fromArray($locationData[0]);

foreach ($addrs as $location) {
  if ($location->isManagedBy($em)) {
    echo "We have $location\n";
  } else {
    echo "We don't have $location\n";
  }
}
