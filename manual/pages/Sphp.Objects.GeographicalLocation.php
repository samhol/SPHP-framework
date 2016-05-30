<?php

namespace Sphp\Util;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

echo $parsedown->text(<<<MD

The geographical location: Classes {$api->getClassLink(Address::class)} and {$api->getClassLink(Location::class)}


Classes {$api->getClassLink(Address::class)} and {$api->getClassLink(Location::class)} 
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Objects/address_location.php");
