<?php

namespace Sphp\Database;

// print_r(Db::query()->get('*')->from('locations')->execute()->fetchAll());
try {
  $hydeparkData = [
      [
          //'name' => 'Hyde Park',
          'street' => 'Koivuluodontie 2',
          'zipcode' => '20240',
          'city' => 'Turku',
          'country' => 'Finland',
      //'maplink' => 'https://goo.gl/maps/ZWHMuHB4sd22'
      ]
      ,
      [
          'street' => 'Rakuunatie 59 A 3',
          'zipcode' => '20720',
          'city' => 'Turku',
          'country' => 'Finland',
      ]
      , [
          'street' => 'W2 2UH',
          'zipcode' => '12538',
          'city' => 'London',
          'country' => 'UK',
      ]
  ];
  $inserter = Db::insert()
          ->into('address')
          ->columnNames('street', 'zipcode', 'city', 'country')
          ->valuesFromCollection($hydeparkData);
  echo $inserter->statementToString();
  var_dump(Db::insert()
                  ->into('address')
                  ->columnNames('street', 'zipcode', 'city', 'country')
                  ->valuesFromCollection($hydeparkData)
                  ->affectRows());
//echo Db::insert()->into('locations')->values($hydeparkData)->affectRows();
} catch (\Throwable $ex) {
  echo $ex;
}

