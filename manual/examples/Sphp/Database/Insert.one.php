<?php

namespace Sphp\Database;
try {
$address = Db::query()->get('id')->from('address')->where(['street', '=', '2210 Quisque Rd.'])->fetchColumn();

echo "\nRows deleted: " . DB::delete()->from('person')
        ->where(['fname', '=', 'Sami'], ['lname', '=', 'Holck'])
        ->affectRows() . "\n";
$insert = DB::insert()
        ->into('person')
        ->columnNames('fname', 'lname', 'sex', 'dob', 'address')
        ->values('Sami', 'Holck', 'm', '1975-09-16');
// print_r(Db::query()->get('*')->from('locations')->execute()->fetchAll());
//echo $insert->statementToString();
echo "\nRows inserted: " . $insert->affectRows() . "\n";


print_r(Db::query()->from('person')->where(['fnames', '=', 'Sami'], ['lname', '=', 'Holck'])->fetchFirstRow());
} catch (\Throwable $ex) {
  echo $ex;
}
