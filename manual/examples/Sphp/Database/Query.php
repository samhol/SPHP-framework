<?php

namespace Sphp\Database;

$q1 = (new Query());
$q1->from("users")
        ->get("fname")
        ->where()
        ->equals(['id' => 1])
        ->orWhere((new Conditions())
                ->isIn('id', range(2, 6))
                ->isNotIn('id', range(-1, 1)));
echo $q1 . "\n";
//var_dump($q1->toArray());
//echo "Result: " . $result[];
