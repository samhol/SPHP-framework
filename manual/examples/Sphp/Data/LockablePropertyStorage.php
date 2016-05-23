<?php

namespace Sphp\Data;

$props = (new LockablePropertyStorage(["a" => 0xa]))
        ->setOutputFormatting(["[", "'%s': %X", "; ", ";", "]"])
        ->lock("b", 0xb)
        ->lockProperties(["c" => 0xc, "d" => 0xd]);
$props["f"] = 0xf;
echo "$props\n";
$props->clear();
echo $props;
?>