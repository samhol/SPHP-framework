<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Manual\Apis;

$php = Apis::phpManual();
$nsLink = Apis::sami()->namespaceLink(__NAMESPACE__);
$collectionInterface = Apis::sami()->classLinker(CollectionInterface::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#DATA STRUCTURES
$ns
The {$php->extensionLink("SPL", "Standard PHP Library (SPL)")} provides a set of standard data structures for PHP language. SPHP
framework contain a few extensions to these for additional properties.

##The $collectionInterface

$collectionInterface implements PHP's native {$php->classLinker("Countable")}, {$php->classLinker("Traversable")}
and {$php->classLinker("ArrayAccess")} interfaces.

$collectionInterface can be used with the {$php->functionLink("count")} function and
{$php->controlStructLink("foreach")} construct. It allows an implementing object
to use PHP's array notation when setting, unsetting and retrieving data from it. This
Interface does not make an object behave like an array in any other way. If an object
that implements $collectionInterface is passed to any {$php->hyperlink("ref.array", "Array Functions")}
except {$php->functionLink("count")} an error will result.

$collectionInterface provides also methods for prepending, appending, searching and removing parts of its contents.

MD
);

\Sphp\Manual\loadPage('Sphp.Stdlib.Datastructures.Collection');
\Sphp\Manual\loadPage('Sphp.Stdlib.Datastructures.StablePriorityQueue');
\Sphp\Manual\loadPage('Sphp.Stdlib.Datastructures.StackInterface');
\Sphp\Manual\loadPage('Sphp.Stdlib.Datastructures.UniquePriorityQueue');
