<?php

namespace Sphp\Db;

$delete = (new Delete());
$delete->from("users")->where()->equals(["fname" => "Sami"]);

echo $delete . "\n";
