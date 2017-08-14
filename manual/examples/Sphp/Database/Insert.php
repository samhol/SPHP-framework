<?php

namespace Sphp\Database;

// print_r(Db::query()->get('*')->from('locations')->execute()->fetchAll());
try {
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
} catch (\Throwable $ex) {
  echo $ex;
}

