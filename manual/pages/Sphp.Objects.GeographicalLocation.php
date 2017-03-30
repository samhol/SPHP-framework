<?php

namespace Sphp\Util;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleAccordion;

echo $parsedown->text(<<<MD

The geographical location: Classes {$api->classLinker(Address::class)} and {$api->classLinker(Location::class)}


Classes {$api->classLinker(Address::class)} and {$api->classLinker(Location::class)} 
MD
);
CodeExampleBuilder::visualize("Sphp/Objects/address_location.php");
