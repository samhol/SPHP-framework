<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$collection = \Sphp\Manual\api()->classLinker(Collection::class);
$collectionInterface = \Sphp\Manual\api()->classLinker(CollectionInterface::class);

\Sphp\Manual\parseDown(<<<MD
##The $collection 

This class provides an implementation of $collectionInterface.

MD
);
CodeExampleBuilder::visualize("Sphp/Stdlib/Datastructures/SphpArrayObject.php", "text", false);
CodeExampleBuilder::visualize("Sphp/Stdlib/Datastructures/Collection.php", "text", false);

