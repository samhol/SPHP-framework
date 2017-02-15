<?php

namespace Sphp\Core;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$router = $api->classLinker(Path::class);
echo $parsedown->text(<<<MD
##Managing absolute paths with a $router singelton object

$router supports transformation of relative filesystem paths to absolute paths for both http urls and local file system.

**IMPORTANT notes about the constructor:** 

* The instance uses global PHP `\$_SERVER` values if present

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Router.php", "text", false);

