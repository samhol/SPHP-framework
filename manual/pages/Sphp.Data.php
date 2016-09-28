<?php

namespace Sphp\Data;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion;

$nsLink = $api->namespaceLink(__NAMESPACE__);
$arrayIfLnk = $api->classLinker(CollectionInterface::class);
$arr = $api->classLinker(SphpArrayObject::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#DATA STRUCTURES
$ns
The {$php->extensionLink("SPL", "Standard PHP Library (SPL)")} provides a set of standard data structures for PHP language. SPHP
framework contain a few extensions to these for additional properties.

##The $arrayIfLnk

$arrayIfLnk extends PHP's native {$php->classLinker("Countable")}, {$php->classLinker("IteratorAggregate")}
and {$php->classLinker("ArrayAccess")} interfaces.

$arrayIfLnk can be used with the {$php->functionLink("count")} function and
{$php->controlStructLink("foreach")} construct. It allows an implementing object
to use PHP's array notation when setting, unsetting and retrieving data from it. This
Interface does not make an object behave like an array in any other way. If an object
that implements $arrayIfLnk is passed to any {$php->hyperlink("ref.array", "Array Functions")}
except {$php->functionLink("count")} an error will result.

$arrayIfLnk provides also methods for prepending and appending data and furthermore clearing all of the date it holds.

##The $arr class

$arr is an instantiable implementation of the $arrayIfLnk interface.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Data/SphpArrayObject.php", "php", false);

$load("Sphp.Data.StablePriorityQueue.php");
$load("Sphp.Data.StackInterface.php");
$load("Sphp.Data.Collection.php");
//$load("Sphp.Data.PrioritizedObjectStorage.php");
//$load("Sphp.Data.UniqueDataContainer.php");
//$load("Sphp.Data.PropertyStorage.php");

?>
