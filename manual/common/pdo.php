<?php

namespace Sphp\Database;

use PDO;

$db = new PDO('mysql:host=Localhost;dbname=int48291_playground;charset=utf8mb4', 'int48291_player', '^E1tT{bEs&}-', array(PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

Db::createFrom($db);
Db::createFrom($db, 'foo');


$db1 = new PDO('mysql:host=Localhost;dbname=int48291_workouts;charset=utf8mb4', 'int48291_workouts', '.qCR8[*3zp(K', array(PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

Db::createFrom($db1, 'workouts');
