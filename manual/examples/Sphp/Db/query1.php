<?php

namespace Sphp\Db;

use Sphp\Objects\User as User;

$q1 = (new Query());
$q1->from("users")
        ->get("fname")
        ->where()
        ->equals([User::DBID => 1])
        ->orWhere((new Conditions())
                ->isIn(User::DBID, range(2, 6))
                ->isNotIn(User::DBID, range(-1, 1)));
echo $q1 . "\n";
var_dump($q1->fetchArray());
//echo "Result: " . $result[];
