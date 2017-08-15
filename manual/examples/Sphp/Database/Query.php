<?php

namespace Sphp\Database;

try {
  $query = Db::query()->get('person.fnames', 'person.lname', 'address.country')
          ->from('person LEFT JOIN address ON address.id = person.address')
          ->where(Rule::isIn('address.country', ['Ireland', 'Sweden', 'Poland']));
          //->where(Rule::is('address.country', 'Poland'));
  //var_dump($query->count());
  print_r($query
          ->groupBy('address.country ASC', 'person.lname')
          ->limit(30)
          ->fetchAll());
} catch (\Throwable $ex) {
  echo $ex;
}