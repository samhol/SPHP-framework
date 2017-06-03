<?php

namespace Sphp\Db;

$update = (new Update())
		->table("`user`", "`session`");
$update->set(["country" => "USA"])
		->where()
			->equals(["country" => "Finland"]);
echo $update . "\n";
