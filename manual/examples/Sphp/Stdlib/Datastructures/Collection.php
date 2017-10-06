<?php

namespace Sphp\Stdlib\Datastructures;

$collection = new Collection(range("b", "d"));

print_r($collection->toArray());

$collection = $collection->filter(function($value) {
          return $value !== 'c';
        });

print_r($collection->toArray());

$collection->merge(array_fill(0, 5, 'merged'));

print_r($collection->toArray());
var_dump(
        $collection->contains("c"),
        $collection->count() === 3,
        $collection->isEmpty() === false,
        $collection->end() === "d");

$collection
        ->prepend("a")
        ->append("e");
print_r($collection->toArray());
var_dump(
        $collection->contains("a"),
        $collection->count() === 5,
        $collection->end() === "e");
