<?php

namespace Sphp\Db\Objects;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Objects\ObjectInterface as ObjectInterface;

$objectInterface = $api->getClassLink(ObjectInterface::class);
$dbObjectInterface = $api->getClassLink(DbObjectInterface::class);
$address = $api->getClassLink(Address::class);
$user = $api->getClassLink(User::class);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Diverse database objects
$ns
This is an experimental [Doctrine](http://www.doctrine-project.org/) based object mapping database extension. 
The Doctrine Project is the home to several PHP libraries primarily focused on database storage and object mapping.

##The {$api->getClassLink(ObjectInterface::class)} and the {$api->getClassLink(DbObjectInterface::class)}

The {$api->getClassLink(ObjectInterface::class)} interface is the base for all implementing classes 
in the {$api->getNamespaceLink(__NAMESPACE__)} namespace.

##The {$api->classLinker(Address::class)} class
Classes $address and {$api->getClassLink(Location::class)}
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/Address.php", "php", false);
echo $parsedown->text(<<<MD
##The {$api->classLinker(User::class)} class
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/User.php", "php", false);

$objectStorageInterface = $api->classLinker(ObjectStorageInterface::class);
$iterable = $php->getClassLink(\IteratorAggregate::class);
$addresses = $api->classLinker(Addresses::class);
$users = $api->classLinker(Users::class);
echo $parsedown->text(<<<MD
##The $objectStorageInterface

This interface provides an $iterable view to the managed $dbObjectInterface entities by extending the native $iterable.
The $objectStorageInterface is implemented by a couple of build-in instantiable classes.
        
1. $addresses for mapping the $address object entities
2. $users for mapping the $user object entities

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/Addresses.php", "php", false);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/Users.php", "php", false);
//$load("Sphp.Net.Password.php");

//CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Objects/address_location.php");

//$load("Sphp.Util.BitMask.php");
