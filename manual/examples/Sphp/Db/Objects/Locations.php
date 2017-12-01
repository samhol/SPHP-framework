<?php

namespace Sphp\Database\Doctrine;

$locationStorage = new LocationStorage();
echo "All locations ordered by Country:\n";
foreach ($locationStorage as $location) {
  echo "\tlocation: {$location->getName()} in {$location->getCountry()}\n";
}
echo "All stored locations in Finland and in UK:\n";
foreach ($locationStorage->findByCountry(['Finland', 'UK']) as $location) {
  echo "\tlocation: {$location->getName()} in {$location->getCity()}\n";
}
echo "All stored locations in Turku:\n";
foreach ($locationStorage->findByProperty('address.city', 'Turku') as $location) {
  echo "\tlocation: {$location->getName()} in {$location->getStreet()}\n";
}
