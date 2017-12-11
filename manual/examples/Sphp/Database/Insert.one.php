<?php

namespace Sphp\Database;

try {
  $address = Db::query()
          ->get('id')
          ->from('address')
          ->where(['street', '=', '2210 Quisque Rd.'])
          ->fetchColumn();

  echo "\nRows deleted: " . DB::delete()->from('person')
          ->where(['fname', '=', 'Sami'], ['lname', '=', 'Holck'])
          ->affectRows() . "\n";

  echo "\nRows inserted: " . DB::insert()
          ->into('person')
          ->columnNames('fname', 'lname', 'sex', 'dob')
          ->values('Sami', 'Holck', 'm', '1975-09-16')
          ->affectRows() . "\n";


  print_r(Db::query()->get("CONCAT(fname, ' ', lname) as name")
                  ->from('person')
                  ->where(['fname', '=', 'Sami'], ['lname', '=', 'Holck'])
                  ->fetchFirstRow());
} catch (\Throwable $ex) {
  echo $ex;
}
