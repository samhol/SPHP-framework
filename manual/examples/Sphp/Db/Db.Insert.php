<?php

namespace Sphp\Db;

use Sphp\Objects\User as User;
use Sphp\Objects\Address as Address;

$user = ["username" => "samhol",
        "fname" => "Sami",
        "lname" => "Holck",
        "streetaddress" => "Rakuunatie 59 A 3",
        "city" => "Turku"];
try {
  Db::connect()->insert("users", $user)->affectRows();
} catch (\Exception $ex) {
  echo get_class($ex) . ": " . $ex->getMessage();
}
