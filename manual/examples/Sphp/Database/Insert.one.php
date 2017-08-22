<?php

namespace Sphp\Database;

$address = Db::query()->get('id')->from('address')->where(['street', '=', '2210 Quisque Rd.'])->fetchColumn();

echo "\nRows deleted: " . DB::delete()->from('person')
        ->where(['fnames', '=', 'Sami'], ['lname', '=', 'Holck'])
        ->affectRows() . "\n";
$insert = DB::insert()
        ->into('person')
        ->columnNames('fnames', 'lname', 'sex', 'dob', 'address')
        ->values('Sami', 'Holck', 'm', '1975-09-16', $address);
// print_r(Db::query()->get('*')->from('locations')->execute()->fetchAll());
//echo $insert->statementToString();
echo "\nRows inserted: " . $insert->affectRows() . "\n";


print_r(Db::query()->from('person')->where(['fnames', '=', 'Sami'], ['lname', '=', 'Holck'])->fetchFirstRow());
