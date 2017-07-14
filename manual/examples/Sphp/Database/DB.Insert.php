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
Db::delete()->from('locations')->where("name = 'Hyde Park'")->execute();
echo Db::insert()
        ->into('locations')
        ->values($hydeparkData)
        ->statementToString();
echo Db::insert()->into('locations')->values($hydeparkData)->execute();
