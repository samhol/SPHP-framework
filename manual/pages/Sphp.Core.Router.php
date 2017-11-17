<?php

namespace Sphp\Core;

use Sphp\Manual;
$router = Manual\api()->classLinker(Path::class);
Manual\parseDown(<<<MD
##Managing absolute paths with a $router singelton object

$router supports transformation of relative filesystem paths to absolute paths 
for both http urls and local file system.

**IMPORTANT notes about the constructor:** 

* The instance uses global PHP `\$_SERVER` values if present

MD
);

Manual\visualize("Sphp/Core/Router.php", "text", false);

