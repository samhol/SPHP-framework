<?php

namespace Sphp\Database;

// print_r(Db::query()->get('*')->from('locations')->execute()->fetchAll());
try {
  $data[] = [
      'street' => 'Koivuluodontie 2',
      'zipcode' => '20240',
      'city' => 'Turku',
      'country' => 'Finland',
  ];
  $data[] = [
      'street' => 'Rakuunatie 59 A 3',
      'zipcode' => '20720',
      'city' => 'Turku',
      'country' => 'Finland',
  ];
  $data[] = [
      'street' => 'W2 2UH',
      'zipcode' => '12538',
      'city' => 'London',
      'country' => 'UK',
  ];
  $inserter = Db::insert()
          ->into('address')
          ->valuesFromArray($data);
  echo $inserter->statementToString();
  $inserter->affectRows();
  var_dump(Db::insert()
                  ->into('address')
                  ->columnNames('street', 'zipcode', 'city', 'country')
                  ->valuesFromArray($hydeparkData)
                  ->affectRows());
//echo Db::insert()->into('locations')->values($hydeparkData)->affectRows();
} catch (\Throwable $ex) {
  echo $ex;
}

