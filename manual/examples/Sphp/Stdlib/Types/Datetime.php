<?php

namespace Sphp\Stdlib;

$now = new Datetime();
$millenium = new Datetime("2000-01-01 00:00:00 EET");
print "millenium is in the past?" . var_export($millenium->past(), true) . "\n";
$tomorrow = new Datetime("tomorrow");
$lastTuesday = new Datetime("yesterday");
var_dump( 
		"$now",
		$tomorrow->future(), 
		$lastTuesday->past(),
		$now->now(), 
		$now->compareTo($millenium),
		$millenium->equals(new Datetime("2000-01-01 00:00:00 EET")),
		$millenium->equals(new Datetime("2000-01-01 00:00:00 CET"))
);
