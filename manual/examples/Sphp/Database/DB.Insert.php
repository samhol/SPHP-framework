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

$stat = $pdo->prepare("insert into `locations` (name, street, zipcode, city, country, maplink) values (?, ?, ?, ?, ?, ?)");
//Db::delete()->from('locations')->where("name = 'Hyde Park'")->execute();
$par = new SequentialPDOParameters($hydeparkData);
$par->executeIn($stat);
echo "insert: \n";
/* $runner->setSql("insert into `locations` values(?, ?, ?, ?, ?, ?)")
  ->setParams($hydeparkData)
  ->execute();
  print_r($runner->setSql('select * from locations')
  ->unsetParams()
  ->execute()
  ->fetchAll(\PDO::FETCH_ASSOC)); */
echo "delete: \n";
var_dump(Db::delete()->from('locations')->where("name", '=', 'Hyde Park')->affectRows());
echo "insert: \n";
/* $runner->setSql("insert into `locations` (name, street, zipcode, city, country, maplink) VALUES (:name, :street, :zipcode, :city, :country, :maplink)", PDORunner::NAMED)
  ->setParams($hydeparkData)
  ->execute(); */
$par->executeIn($stat);
//print_r($runner->setSql('select * from locations')->unsetParams()->execute()->fetchAll(\PDO::FETCH_ASSOC));
echo "delete: \n";
var_dump(Db::delete()->from('locations')->where("name", '=', 'Hyde Park')->affectRows());
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
