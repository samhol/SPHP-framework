<?php

namespace Sphp\Core\Types;

$now = new Datetime();
$millenium = new Datetime("2000-01-01");
$tomorrow = new Datetime("tomorrow");
$yesterday = new Datetime("yesterday");
var_dump( 
		"$now",
		$tomorrow->future(), 
		$yesterday->past(),
		$now->now(), 
		$now->compareTo($millenium),
		$millenium->equals(new Datetime("2000-01-01"))
);
?>
