<?php

namespace Sphp\Db\Objects;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Objects\ObjectInterface;

$objectInterface = Apis::apigen()->classLinker(ObjectInterface::class);
$dbObjectInterface = Apis::apigen()->classLinker(DbObjectInterface::class);
$geographicalAddress = Apis::apigen()->classLinker(GeographicalAddressInterface::class);
$location = Apis::apigen()->classLinker(Location::class);
$user = Apis::apigen()->classLinker(User::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

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
(new CodeExampleBuilder("Sphp/Db/Objects/Location.php", "text", false))
        ->setExamplePaneTitle("Geographical address object example")
        ->printHtml();



$objectStorageInterface = Apis::apigen()->classLinker(ObjectStorageInterface::class);
$iterable = Apis::phpManual()->classLinker(\IteratorAggregate::class);
$addresses = Apis::apigen()->classLinker(LocationStorage::class);
$users = Apis::apigen()->classLinker(Users::class);
echo $parsedown->text(<<<MD
##The $objectStorageInterface

This interface provides an $iterable view to the managed $dbObjectInterface entities by 
extending the native $iterable and providing some additional methods for entity manipulation.
The $objectStorageInterface is implemented by a couple of build-in instantiable classes.
        
1. $addresses for mapping the $location object entities
2. $users for mapping the $user object entities

MD
);
CodeExampleBuilder::visualize("Sphp/Db/Objects/Locations.php", "text", false);


$load("Sphp.Db.Objects.Session.php");
//$load("Sphp.Net.Password.php");

//CodeExampleBuilder::visualize("Sphp/Objects/address_location.php");

//$load("Sphp.Util.BitMask.php");
