<?php

namespace Sphp\Core;

use Sphp\Html\Apps\Manual\Apis as Apis;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

echo <<<MD
##Highlights:

Core components are a collection of miscellaneous classes. These classes can be groupped into:

 * Configuration and error handling
 * Variable manipulation
 * Human language translation
 * Event dispatching      
MD
;
