<?php

namespace Sphp\Database;

try {
  $query = Db::query()->get('name', 'street', 'zipcode', 'city', 'country')
          ->from('locations');
  var_dump($query->count());
  print_r($query
          ->groupBy('country ASC', 'name')
          ->limit(5)
          ->fetchAll());
} catch (\Throwable $ex) {
  echo $ex;
}
