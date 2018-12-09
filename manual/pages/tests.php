<?php

use Sphp\Data\Person;

echo "<pre>";

$person = new Person();
$person->setFname('Vilho')->setLname('Koivisto');
$person->setDateOfBirth('1918-01-07');
$person->setDateOfDeath('2016-12-05');
var_dump($person->getAge()->y);
$person->getAddress()->setStreet('Tuohimaantie 14')->setCity('Loimaa')->setCountry('Finland');
echo $person;


$person1 = new Person();
$person1->setFname('Vilho')->setLname('Koivisto');
$person1->setDateOfBirth('1918-01-07');
$person1->getAddress()->setStreet('Tuohimaantie 14')->setCity('Loimaa')->setCountry('Finland');
echo $person1;
echo "</pre>";
