<?php

namespace Sphp\Db;

try {
  $query = Db::connect()->delete("users", "username = 'foo'");
  echo $query;
} catch (\Exception $ex) {
  echo get_class($ex) . ": " . $ex->getMessage();
}
