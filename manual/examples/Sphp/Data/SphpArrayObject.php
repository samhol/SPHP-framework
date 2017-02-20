<?php
namespace Sphp\Stdlib\Datastructures;

$arr = new Collection(['a', 'b', 'c' => 'c']);
//append data
$arr->append(['a', 'b', 'c']);
//use array notations
$arr[] = "'append'";
$arr['remove'] = "removable value";
$arr[10] = "gets rearranged";
//decimal keys are floored to integers
$arr->append('appended');
$arr->prepend('prepending resets numeric keys');
$arr[10] = 'key 10';
$arr[51.8] = 'key 51 (rounded down)';
//unset an insertion
unset($arr["remove"]);
//prepend data -> numeric keys will be renumbered starting from zero
print_r($arr);
echo "number of entries: " . $arr->count();
?>
