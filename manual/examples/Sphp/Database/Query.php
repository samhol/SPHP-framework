<?php

namespace Sphp\Database;

try {
  $query = Db::query()->get('fnames', 'lname', 'country')
          ->from('person LEFT JOIN address ON address.id = person.address')
          ->where(Rule::isIn('country', ['Ireland', 'Sweden', 'Poland']));
          //->where(Rule::is('address.country', 'Poland'));
  //var_dump($query->count());
  print_r($query
          ->groupBy('address.country ASC', 'person.lname')
          ->setLimit(5)
          ->setOffset(10)
          ->fetchAll());
} catch (\Throwable $ex) {
  echo $ex;
}
