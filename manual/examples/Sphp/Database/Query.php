<?php

namespace Sphp\Database;

$db = new \PDO('mysql:host=Localhost;dbname=int48291_playground;charset=utf8mb4', 'int48291_player', '^E1tT{bEs&}-', array(\PDO::ATTR_EMULATE_PREPARES => false, 
                                                                                                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
$q1 = (new Query($db));
$q1->from("users")
        ->where()
        ->equals(['id' => 1])
        ->orWhere((new Conditions())
                ->isIn('id', range(2, 6))
                ->isNotIn('id', range(-1, 1)));
echo $q1 . "\n";
echo $q1->get('fname', 'lname') . "\n";
//var_dump($q1->toArray());
//echo "Result: " . $result[];
