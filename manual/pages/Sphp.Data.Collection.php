<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$collection = $api->classLinker(Collection::class);
$collectionInterface = $api->classLinker(CollectionInterface::class);
echo $parsedown->text(<<<MD
##The $collection 

This class provides an implementation of $collectionInterface.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/SphpArrayObject.php", "text", false);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/Collection.php", "text", false);
?>
