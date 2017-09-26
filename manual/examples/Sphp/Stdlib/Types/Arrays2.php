<?php

namespace Sphp\Stdlib;

$arr1 = [0, [1, 2, [3, 4, [5, 6], 7], 8], 9];

print_r($arr1);
print_r(Arrays::flatten($arr1));
$arr2 = ["a", "b", "c", "d", "e"];
echo Arrays::implode($arr2, ", ", " and ") . "\n";

echo Arrays::implodeWithKeys($arr2, ", ", " => ") . "\n";
$arr3 = ["a" => [1 => "value1"]];
echo "\narr3['a']['1'] = ";
var_dump(Arrays::getValue($arr3, "a", "1"));
var_dump(Arrays::getValue($arr3, "foo", "bar"));
