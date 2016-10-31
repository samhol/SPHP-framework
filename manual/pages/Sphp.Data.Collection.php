<?php

namespace Sphp\Data;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$collection = $api->classLinker(Collection::class);
$collectionInterface = $api->classLinker(CollectionInterface::class);
$stackInterface = $api->classLinker(StackInterface::class);
echo $parsedown->text(<<<MD
##The $collection 

This class provides an implementation of $collectionInterface.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/SphpArrayObject.php", "php", false);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/Collection.php", "php", false);
?>
