<?php

namespace Sphp\Data;

$props = (new UniqueDataContainer(["string", 0xa, FALSE]))
        ->setOutputFormatting(["[", "'%s'", ", ", "", "]"])
        ->add("string")->add(NULL);

echo "Unique values: $props\n";
$props->remove(FALSE);
echo "Unique values: $props\n";
$props->clear();
echo "Unique values: $props";
?>