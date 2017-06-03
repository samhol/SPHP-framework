<?php

namespace Sphp\Stdlib\Datastructures;

$collection = (new Collection(range("b", "d")));
echo "[$collection]\n";
var_dump(
        $collection->contains("c"),
        $collection->count() === 3,
        $collection->isEmpty() === false,
        $collection->end() === "d");

$collection
        ->prepend("a")
        ->append("e");
echo "[$collection]\n";
var_dump(
        $collection->contains("a"),
        $collection->count() === 5,
        $collection->end() === "e");
