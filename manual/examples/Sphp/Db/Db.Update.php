<?php

namespace Sphp\Db;

$user = ["username" => "samhol",
    "fname" => "Sami",
    "lname" => "Holck",
    "streetaddress" => "Rakuunatie 59 A 3",
    "city" => "Turku"];
try {
  $update = Db::connect()->update("users", $user);
  $update->where()->equals(["username" => "samhol"]);
  echo "Affected:" . $update->set($user)->affectRows();
} catch (\Exception $ex) {
  echo get_class($ex) . ": " . $ex->getMessage();
}
