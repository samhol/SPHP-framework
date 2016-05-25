<?php

namespace Sphp\Db\Objects;

$em = include 'entityManager.php';

$addr1Data = [
    "street" => "12 Unknown st.",
    "zipcode" => "20720",
    "city" => "Canberra",
    "country" => "Wonderland",
];
$addr3Data = [
    "street" => "PL 347",
    "zipcode" => "33101",
    "city" => "Tampere",
    "country" => "Finland",
];

$addrs[] = new Address($addr1Data);

$addrs[] = (new Address())
        ->setStreet("Mariankatu 2")
        ->setZipcode("00170")
        ->setCity("Helsinki")
        ->setCountry("Finland");

$addrs[] = (new Address())
        ->fromArray($addr3Data);

foreach ($addrs as $addr) {
  if ($addr->isManagedBy($em)) {
    echo "We have $addr\n";
  } else {
    echo "We don't have $addr\n";
  }
}
