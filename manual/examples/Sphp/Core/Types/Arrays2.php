<?php

namespace Sphp\Stdlib;

$arr1 = ["a", "b",
	[
		'a' => '1. sub',
		'b' => ['1.1. sub', 'equal']
	],
	[
		'c' => '2. sub',
		'd' => ['2.1. sub', 'equal']
	]
];

print_r(Arrays::flatten($arr1));
$arr2 = ["a", "b", "c", "d", "e"];
echo Arrays::implode($arr2, ", ", " and ") . "\n";

echo Arrays::implodeWithKeys($arr2, ", ", " => ") . "\n";
$arr3 = ["a" => [1 => "value1"]];
echo "\narr3['a']['1'] = ";
var_dump(Arrays::getValue($arr3, ["a", "1"]));
var_dump(Arrays::getValue($arr3, ["foo", "bar"]));
?>
