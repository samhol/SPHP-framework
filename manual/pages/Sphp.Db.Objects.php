<?php

namespace Sphp\Db\Objects;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Objects\ObjectInterface;

$objectInterface = Apis::sami()->classLinker(ObjectInterface::class);
$dbObjectInterface = Apis::sami()->classLinker(DbObjectInterface::class);
$geographicalAddress = Apis::sami()->classLinker(GeographicalAddressInterface::class);
$location = Apis::sami()->classLinker(Location::class);
$user = Apis::sami()->classLinker(User::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

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



$objectStorageInterface = Apis::sami()->classLinker(ObjectStorageInterface::class);
$iterable = Apis::phpManual()->classLinker(\IteratorAggregate::class);
$addresses = Apis::sami()->classLinker(LocationStorage::class);
$users = Apis::sami()->classLinker(Users::class);
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


$load('Sphp.Db.Objects.Session');
