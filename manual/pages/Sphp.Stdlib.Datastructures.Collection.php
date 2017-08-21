<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$collection = Apis::sami()->classLinker(Collection::class);
$collectionInterface = Apis::sami()->classLinker(CollectionInterface::class);

\Sphp\Manual\parseDown(<<<MD
##The $collection 

This class provides an implementation of $collectionInterface.

MD
);
CodeExampleBuilder::visualize("Sphp/Data/SphpArrayObject.php", "text", false);
CodeExampleBuilder::visualize("Sphp/Data/Collection.php", "text", false);

