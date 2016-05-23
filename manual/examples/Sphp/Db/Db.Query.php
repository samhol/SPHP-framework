<?php

namespace Sphp\Db;

try {
  $query = Db::connect()->query("users")
          ->get(["username", "fname", "lname"]);
  $query->where()->equals(["fname" => "Sami"]);
  echo new \Sphp\Html\Lists\Ul($query->fetchArray()[0]);
} catch (\Exception $ex) {
  echo get_class($ex) . ": " . $ex->getMessage();
}
