<?php

namespace Sphp\Core;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$config = $api->classLinker(Configuration::class);
$phpConfig = $api->classLinker(PHPConfiguration::class);
$pathFinder = $api->classLinker(PathFinder::class);
echo $parsedown->text(<<<MD
##Managing absolute paths with a $pathFinder object

$pathFinder supports transformation of relative filesystem paths to absolute paths for both http urls and local file system.

**IMPORTANT:** 

* The `\$localRoot` parameter should be an Absolute path so that all the subfolders are reachable.
* If either `\$localRoot` or `\$httpRoot` is not given the instance uses global PHP `\$_SERVER` values if present

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/PathFinder.php", "text", false);

