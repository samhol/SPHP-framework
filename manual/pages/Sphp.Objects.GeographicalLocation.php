<?php

namespace Sphp\Util;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$bitMaskLink = $api->getClassLink(BitMask::class);
$and = $api->getClassMethodLink(BitMask::class, "and_");
$or = $api->getClassMethodLink(BitMask::class, "or_");
$xor = $api->getClassMethodLink(BitMask::class, "xor_");
echo $parsedown->text(<<<MD

The geographical location: Classes {$api->getClassLink(Address::class)} and {$api->getClassLink(Location::class)}


Classes {$api->getClassLink(Address::class)} and {$api->getClassLink(Location::class)} 
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Objects/address_location.php");
