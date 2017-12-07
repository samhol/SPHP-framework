<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$collection = \Sphp\Manual\api()->classLinker(Collection::class);
$collectionInterface = \Sphp\Manual\api()->classLinker(CollectionInterface::class);

\Sphp\Manual\md(<<<MD
##The $collection 

This class provides an implementation of $collectionInterface.

MD
);
CodeExampleAccordionBuilder::visualize('Sphp/Stdlib/Datastructures/SphpArrayObject.php', 'text', false);
CodeExampleAccordionBuilder::visualize('Sphp/Stdlib/Datastructures/Collection.php', 'text', false);

