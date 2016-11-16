<?php

namespace Sphp\Db\Objects;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Objects\ObjectInterface;

$objectInterface = $api->classLinker(ObjectInterface::class);
$dbObjectInterface = $api->classLinker(DbObjectInterface::class);
$geographicalAddress = $api->classLinker(GeographicalAddressInterface::class);
$location = $api->classLinker(Location::class);
$user = $api->classLinker(User::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Diverse database objects
$ns
This is an experimental [Doctrine](http://www.doctrine-project.org/) based object mapping database extension. 
The Doctrine Project is the home to several PHP libraries primarily focused on database storage and object mapping.

##The $objectInterface and the $dbObjectInterface

The $objectInterface interface is the base for all database entity objects in the {$api->namespaceLink(__NAMESPACE__)} namespace.


This interfaces are the base of all database objects
The $dbObjectInterface is implemented by a couple of build-in instantiable classes.
####$location implementing $geographicalAddress for geographical address entities

MD
);
(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Db/Objects/Location.php", "text", false))
        ->setExampleHeading("Geographical address object example")
        ->printHtml();



$objectStorageInterface = $api->classLinker(ObjectStorageInterface::class);
$iterable = $php->classLinker(\IteratorAggregate::class);
$addresses = $api->classLinker(LocationStorage::class);
$users = $api->classLinker(Users::class);
echo $parsedown->text(<<<MD
##The $objectStorageInterface

This interface provides an $iterable view to the managed $dbObjectInterface entities by 
extending the native $iterable and providing some additional methods for entity manipulation.
The $objectStorageInterface is implemented by a couple of build-in instantiable classes.
        
1. $addresses for mapping the $location object entities
2. $users for mapping the $user object entities

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/Locations.php", "text", false);


$load("Sphp.Db.Objects.Session.php");
//$load("Sphp.Net.Password.php");

//CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Objects/address_location.php");

//$load("Sphp.Util.BitMask.php");
