<?php

namespace Sphp\Db;

$user = ["username" => "samhol",
        "fname" => "Sami",
        "lname" => "Holck",
        "streetaddress" => "Rakuunatie 59 A 3",
        "city" => "Turku"];
try {
  $table = Db::table("users");
  echo "deleted: ". $table->delete("username = 'samhol'")->affectRows();
  echo "inserted: ". $table->insert($user)->affectRows();
  $table->update("username = 'samhol'")->set(["permissions" => 0b11]);
  echo "samhol exists: ". $table->query("username = 'samhol'")->get("username")->count();
} catch (\Exception $ex) {
  echo get_class($ex) . ": " . $ex->getMessage();
}