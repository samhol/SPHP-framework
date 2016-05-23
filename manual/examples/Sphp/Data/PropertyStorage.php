<?php

namespace Sphp\Data;

$props = (new PropertyStorage(["a" => 0xa, "a" => 0xb]))
        ->setOutputFormatting(["[", "'%s': %X", "; ", ";", "]"])
        ->set("c", 0xc)
        ->setProperties(["d" => 0xd, "e" => 0xe]);
$props["f"] = 0xf;
echo "Props: $props\n";
$props->remove(range("c", "f"));
echo "Props: $props\n";
$props->clear();
echo "Props: $props";
?>