<?php

namespace Sphp\Util;

$arr1 = ["a", "a"];
$arr2 = [1 => "a", 0 => "b"];
$arr3 = ["a", "b" => "a"];

var_dump(Arrays::isIndexed($arr1));
var_dump(Arrays::isIndexed($arr2));
var_dump(Arrays::isIndexed($arr3));

var_dump(Arrays::isSequential($arr1));
var_dump(Arrays::isSequential($arr2));
var_dump(Arrays::isSequential($arr3));

$testA = function($key, $val) {
	return $val === "a";
};

var_dump(Arrays::test($arr1, $testA));
var_dump(Arrays::test($arr2, $testA));
var_dump(Arrays::test($arr3, $testA));

?>