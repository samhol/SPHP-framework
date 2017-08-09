<?php

namespace Sphp\Database;

$db = new \PDO('mysql:host=Localhost;dbname=int48291_playground;charset=utf8mb4', 'int48291_player', '^E1tT{bEs&}-', array(\PDO::ATTR_EMULATE_PREPARES => false, 
                                                                                                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION));
$q1 = (new Query($db));
$q1->from("users")
        ->where('a=1')
        ->orWhere('a=2');
echo $q1 . "\n";
echo $q1->get('fname', 'lname') . "\n";
//var_dump($q1->toArray());
//echo "Result: " . $result[];
