<?php

namespace Sphp\Database\Doctrine\Objects;

include_once 'manual/doctrine/configuration.php';

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Database\Doctrine\Objects\ObjectInterface;
use Sphp\Manual;

$objectInterface = Manual\api()->classLinker(ObjectInterface::class);
$dbObjectInterface = Manual\api()->classLinker(DbObjectInterface::class);
$geographicalAddress = Manual\api()->classLinker(GeographicalAddress::class);
$location = Manual\api()->classLinker(Location::class);
$user = Manual\api()->classLinker(User::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\parseDown(<<<MD
#Diverse database objects
$ns
This is an experimental [Doctrine](http://www.doctrine-project.org/) based object mapping database extension. 
The Doctrine Project is the home to several PHP libraries primarily focused on database storage and object mapping.
* [Doctrine](http://www.doctrine-project.org/){target="_blank"} — <i class="tech label php"></i><i class="tech label sql"></i>
    The Doctrine Project is the home to several PHP libraries primarily focused on database storage and object mapping. The core projects are a Object Relational Mapper (ORM) and the Database Abstraction Layer (DBAL) it is built upon. Doctrine has greatly benefited from concepts of the Hibernate ORM and has adapted them to fit the PHP language

##The $objectInterface and the $dbObjectInterface

The $objectInterface interface is the base for all database entity objects in the namespace.


This interfaces are the base of all database objects
The $dbObjectInterface is implemented by a couple of build-in instantiable classes.
####$location implementing $geographicalAddress for geographical address entities

MD
);
Manual\visualize('Sphp/Db/Objects/Locations.php', 'text', false);
Manual\example('Sphp/Db/Objects/Location.php', 'text', false)
        ->setExamplePaneTitle("Geographical address object example")
        ->printHtml();

/*

$objectStorageInterface = \Sphp\Manual\api()->classLinker(ObjectStorageInterface::class);
$iterable = Apis::phpManual()->classLinker(\IteratorAggregate::class);
$addresses = \Sphp\Manual\api()->classLinker(LocationStorage::class);
$users = \Sphp\Manual\api()->classLinker(Users::class);
\Sphp\Manual\parseDown(<<<MD
##The $objectStorageInterface

This interface provides an $iterable view to the managed $dbObjectInterface entities by 
extending the native $iterable and providing some additional methods for entity manipulation.
The $objectStorageInterface is implemented by a couple of build-in instantiable classes.
        
1. $addresses for mapping the $location object entities
2. $users for mapping the $user object entities

MD
);
CodeExampleBuilder::visualize("Sphp/Db/Objects/Locations.php", "text", false);


\Sphp\Manual\loadPage('Sphp.Db.Objects.Session');
*/
