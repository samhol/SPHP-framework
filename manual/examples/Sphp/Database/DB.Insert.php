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

//Db::delete()->from('locations')->where("name = 'Hyde Park'")->execute();
$runner = new PDORunner(Db::instance()->getPdo());
echo "insert: \n";
$runner->setSql("insert into `locations` values(?, ?, ?, ?, ?, ?)")
        ->setParams($hydeparkData)
        ->execute();
print_r($runner->setSql('select * from locations')
                ->unsetParams()
                ->execute()
                ->fetchAll(\PDO::FETCH_ASSOC));
echo "delete: \n";
var_dump(Db::delete()->from('locations')->where("name = 'Hyde Park'")->affectRows());
echo "insert: \n";
$runner->setSql("insert into `locations` values(:name, :street, :zipcode, :city, :country, :maplink)", PDORunner::NAMED)
        ->setParams($hydeparkData)
        ->execute();
print_r($runner->setSql('select * from locations')->unsetParams()->execute()->fetchAll(\PDO::FETCH_ASSOC));
echo "delete: \n";
var_dump(Db::delete()->from('locations')->where("name = 'Hyde Park'")->affectRows());
echo "insert: \n";
var_dump(Db::insert()
                ->into('locations')
                ->valuesFromArray($hydeparkData)
                ->affectRows());
//echo Db::insert()->into('locations')->values($hydeparkData)->affectRows();

print_r($runner->setSql('select * from locations')
                ->unsetParams()
                ->execute()
                ->fetchAll(\PDO::FETCH_ASSOC));
