<?php

namespace Sphp\Database;

// print_r(Db::query()->get('*')->from('locations')->execute()->fetchAll());
try {
  $query = Db::query()->get('*')->from('locations')
        ->limit(10, 20);
  print_r($query->fetchAll());
  var_dump(Db::delete()->from('locations')->where(Rule::is('name', 'Hyde Park'))->execute()->rowCount());
  $hydeparkData = [
      'name' => 'Hyde Park',
      'street' => 'W2 2UH',
      'zipcode' => '12538',
      'city' => 'London',
      'country' => 'UK',
      'maplink' => 'https://goo.gl/maps/ZWHMuHB4sd22'
  ];
  var_dump(Db::insert()
                  ->into('locations')
                  ->valuesFromCollection($hydeparkData)
                  ->affectRows());
//echo Db::insert()->into('locations')->values($hydeparkData)->affectRows();

  print_r($query->fetchAll());
} catch (\Throwable $ex) {
  echo new \Sphp\Html\Foundation\Sites\Containers\ThrowableCallout($ex);
}

