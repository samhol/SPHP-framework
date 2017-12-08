<?php

namespace Sphp\Database;

use Sphp\Database\Rules\Rule;

try {
  $query = Db::query()->get('fname', 'lname', 'country')
          ->from('person LEFT JOIN address ON address.id = person.address')
          ->where(Rule::isIn('country', ['Finland', 'Sweden', 'Myanmar']));
  //->where(Rule::is('address.country', 'Poland'));
  //var_dump($query->count());
  echo $query->statementToString();
  print_r($query
                  ->groupBy('address.country ASC', 'person.lname')
                  ->setLimit(5)
                  ->setOffset(1)
                  ->fetchAll());
} catch (\Throwable $ex) {
  echo $ex;
}
