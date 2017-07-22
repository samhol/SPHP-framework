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

$runner = new TaskRunner(Db::instance()->getPdo());
$runner->setSql("insert into `locations` values('Hyde Park','W2 2UH', '12538', 'London', 'UK','https://goo.gl/maps/ZWHMuHB4sd22')")->execute();
var_dump($runner->setSql('select * from locations')->execute()->fetchAll());
//Db::delete()->from('locations')->where("name = 'Hyde Park'")->execute();
echo Db::insert()
        ->into('locations')
        ->valuesFromArray($hydeparkData)
        ->statementToString();
//echo Db::insert()->into('locations')->values($hydeparkData)->affectRows();
