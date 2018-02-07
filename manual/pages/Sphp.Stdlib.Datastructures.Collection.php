<?php

namespace Sphp\Stdlib\Datastructures;

$collection = \Sphp\Manual\api()->classLinker(Collection::class);
$collectionInterface = \Sphp\Manual\api()->classLinker(CollectionInterface::class);

\Sphp\Manual\md(<<<MD
##The $collection 

This class provides an implementation of $collectionInterface.

MD
);
\Sphp\Manual\visualize('Sphp/Stdlib/Datastructures/SphpArrayObject.php', 'text', false);
\Sphp\Manual\visualize('Sphp/Stdlib/Datastructures/Collection.php', 'text', false);

