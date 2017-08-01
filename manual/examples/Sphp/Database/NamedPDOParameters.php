<?php

namespace Sphp\Database;

$hydeparkData = [
    'name' => 'Hyde Park',
    'street' => 'W2 2UH',
    'zipcode' => '12538',
    'city' => 'London',
    'country' => 'UK',
    'maplink' => 'https://goo.gl/maps/ZWHMuHB4sd22'
];
$pdo = Db::instance()->getPdo();
$statement1 = $pdo->prepare('select * from locations where name = :name');
$statement2 = $pdo->prepare('insert into locations (name, street, zip, city, country, maplink) values(:name, :street, :zipcode, :city, :country, :maplink)');
//Db::delete()->from('locations')->where("name = 'Hyde Park'")->execute();
$runner = new NamedPDOParameters();
echo "insert: \n";
$runner->setParams($hydeparkData);
$runner->executeIn($statement2);
