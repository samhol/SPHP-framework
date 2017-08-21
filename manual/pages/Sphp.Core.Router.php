<?php

namespace Sphp\Core;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$router = Apis::sami()->classLinker(Path::class);
\Sphp\Manual\parseDown(<<<MD
##Managing absolute paths with a $router singelton object

$router supports transformation of relative filesystem paths to absolute paths for both http urls and local file system.

**IMPORTANT notes about the constructor:** 

* The instance uses global PHP `\$_SERVER` values if present

MD
);

CodeExampleBuilder::visualize("Sphp/Core/Router.php", "text", false);

