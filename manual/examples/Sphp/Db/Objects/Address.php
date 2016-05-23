<?php

namespace Sphp\Db\Objects;

$em = include 'entityManager.php';

$addrs = new Addresses($em);
$addr1Data = [
    "street" => "12 Unknown st.",
    "zipcode" => "20720",
    "city" => "Canberra",
    "country" => "Wonderland",
];
$addrData2 = [
    "street" => "Rakuunatie 59 A 3",
    "zipcode" => "20720",
    "city" => "Turku",
    "country" => "Finland",
];
$addr1 = new Address($addr1Data);
$addr2 = new Address($addrData2);
foreach ($addrs as $addr) {
  echo "$addr\n";
}
echo "addr1:\n";
print_r($addr1->toArray());

if ($addr1->isManagedBy($em)) {
  echo "We have addr1\n";
} else {
  echo "We don't have user addr1\n";
}
echo "addr2:\n";
print_r($addr2->toArray());
if ($addr2->isManagedBy($em)) {
  echo "We have addr2\n";
} else {
  echo "We don't have user addr2\n";
}

return $addr2;
?>