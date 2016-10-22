<?php

namespace Sphp\Data;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$collection = $api->classLinker(Collection::class);
$stackInterface = $api->classLinker(StackInterface::class);
echo $parsedown->text(<<<MD
##The $collection class

This class provides a wrapper for working with arrays of data.

$collection implements $stackInterface and can therefore be used as a
last-in-first-out (LIFO) stack of items.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/Collection.php", "php", false);
?>