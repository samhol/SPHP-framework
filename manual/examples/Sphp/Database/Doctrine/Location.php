<?php

namespace Sphp\Database\Doctrine\Objects;

use Sphp\Database\Doctrine\LocationStorage;

$em = \Sphp\Database\Doctrine\EntityManagerFactory::get();
$locationStorage = new LocationStorage($em);
$hydeparkData = [
    'name' => 'Hyde Park',
    'street' => 'W2 2UH',
    'zipcode' => '12538',
    'city' => 'London',
    'country' => 'UK',
    'maplink' => 'https://goo.gl/maps/ZWHMuHB4sd22'
];
$locationStorage->removeByName($hydeparkData["name"]);
var_dump($locationStorage->findByName($hydeparkData["name"]));
$locationStorage->insertAsNew(new Location($hydeparkData));
var_dump($locationStorage->findByName($hydeparkData["name"]));
//$hydepark = new Location($hydeparkData);
$location2 = new Location([
    'name' => 'Pikkukakkosen posti',
    'street' => "PL 347",
    'zipcode' => "33101",
    'city' => 'Tampere',
    'country' => 'Finland',
    'maplink' => 'Finland',
        ]);
try {

//$locationStorage->removeByName('Pikkukakkosen posti');
  $locationStorage->insertAsNew($location2);
} catch (\Exception $ex) {
  echo $ex->getMessage();
}
//$locationStorage = new LocationStorage();
/*try {
  //$hydepark->insertAsNewInto($em);
} catch (\Exception $ex) {
  echo "Hydepark is already stored into the database\n";
  $hydepark = $locationStorage->findByName($hydepark);
}
$addrs[] = $hydepark;
//$locations->save($hydepark);
$addrs[] = (new Location())->setAddress(
        (new Address())->setStreet("Mariankatu 2")
                ->setZipcode("00170")
                ->setCity("Helsinki")
                ->setCountry("Finland"));


foreach ($addrs as $location) {
  if ($locationStorage->contains($location)) {
    echo "We have $location\n";
  } else {
    echo "We don't have $location\n";
  }
}
*/
