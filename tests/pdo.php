<?php

namespace Sphp\Database;

use PDO;

try {
  $db = new PDO('mysql:host=127.0.0.1;port=3306;dbname=test;charset=utf8mb4', 'root', '', array(PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

  Db::createFrom($db);

  Db::createFrom($db, 'test');
} catch (\Exception $ex) {
  
}
