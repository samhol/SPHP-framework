<?php

namespace Sphp\Db\Objects;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Objects\ObjectInterface as ObjectInterface;

$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);

echo $parsedown->text(<<<MD
#Diverse database objects
$ns
Namespace {$api->getNamespaceLink(__NAMESPACE__)} contains a group of classes for wide range of purposes. 
The reason for them to be in the same namespace is that they all inherit some common interfaces.

##The {$api->getClassLink(ObjectInterface::class)} and the {$api->getClassLink(DbObjectInterface::class)}

The {$api->getClassLink(ObjectInterface::class)} interface is the base for all implementing classes 
in the {$api->getNamespaceLink(__NAMESPACE__)} namespace.

##The {$api->classLinker(Address::class)} class
Classes {$api->getClassLink(Address::class)} and {$api->getClassLink(Location::class)}
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/Address.php", "php", false);
echo $parsedown->text(<<<MD
##The {$api->classLinker(User::class)} class
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/User.php", "php", false);
echo $parsedown->text(<<<MD
##The {$api->classLinker(ObjectStorageInterface::class)}
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/ObjectStorageInterface.php", "php", false);
//$load("Sphp.Net.Password.php");

//CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Objects/address_location.php");

//$load("Sphp.Util.BitMask.php");
