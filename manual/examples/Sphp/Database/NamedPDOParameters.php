<?php

namespace Sphp\Database;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

try {


  $hydeparkData = [
      'name' => 'Hyde Park',
      'street' => 'W2 2UH',
      'zipcode' => '12538',
      'city' => 'London',
      'country' => 'UK',
      'maplink' => 'https://goo.gl/maps/ZWHMuHB4sd22'
  ];
  $par = new NamedParameters();

  $par->setParam('a', 'b', \PDO::PARAM_STR);
  $par->setParam('b', '4', \PDO::PARAM_INT);
  foreach ($par as $key => $val) {
    echo "$key: $val\n";
  }
  $pdo = Db::instance()->getPdo();
  $statement1 = $pdo->prepare('select * from locations where name = :name');
  Db::delete()->from('locations')->where(["name", "=", 'Hyde Park'])->execute();
  $statement2 = $pdo->prepare('insert into locations (name, street, zipcode, city, country, maplink) values (:name, :street, :zipcode, :city, :country, :maplink)');
//Db::delete()->from('locations')->where("name = 'Hyde Park'")->execute();
  $runner = new NamedParameters();
  ///$runner['a'] = "foo";
  echo "insert: \n";
  $runner->setParams($hydeparkData);
  $runner->executeIn($statement2);
} catch (\Exception $ex) {
  echo ThrowableCalloutBuilder::build($ex, true, true);
}
