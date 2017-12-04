<?php

namespace Sphp\Database\Doctrine;

$em = \Sphp\Database\Doctrine\EntityManagerFactory::get();
$locationStorage = new LocationStorage($em);
/* echo "All locations ordered by Country:\n";
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
  } */
try {
  foreach ($locationStorage->toArray() as $location) {
    echo "\n{$location->getName()} in {$location->getAddress()->getCity()}, {$location->getAddress()->getCountry()}";
}
  $l = $locationStorage->query()
                  ->select('l')
                  ->from(Objects\Location::class, 'l')
                  ->where('l.address.country = :co')
                  ->setParameter('co', 'Finland')->getQuery();
  var_dump($l->execute());
  var_dump($locationStorage->propNotUsed('address.city', 'Turku'));
  var_dump($locationStorage->propNotUsed('address.city', 'Ongole'));
} catch (\Exception $ex) {
  echo $ex;
}
echo $locationStorage['Pikkukakkosen posti']->getAddress();


/*foreach ($l->getResult() as $o) {
  echo "\tlocation: {$o->getName()} in {$o->getCountry()}\n";
}7*/
