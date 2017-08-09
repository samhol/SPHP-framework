<?php

namespace Sphp\Database;
$del = Db::delete()->from('locations')->where(Rule::is('name', 'Hyde Park'))->execute();
$hydeparkData = [
    'name' => 'Hyde Park',
    'street' => 'W2 2UH',
    'zipcode' => '12538',
    'city' => 'London',
    'country' => 'UK',
    'maplink' => 'https://goo.gl/maps/ZWHMuHB4sd22'
];
$pdo = Db::instance()->getPdo();
var_dump(Db::insert()
                ->into('locations')
                ->valuesFromArray($hydeparkData)
                ->affectRows());
//echo Db::insert()->into('locations')->values($hydeparkData)->affectRows();

print_r(Db::query()->get('*')->from('locations')->execute()->fetchAll());
