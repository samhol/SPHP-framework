<?php

namespace Sphp\Core;

$apigen = \Sphp\Manual\api();
$ns = $apigen->namespaceBreadGrumbs(__NAMESPACE__);

use Sphp\Config\Config;

$rootNs = $apigen->namespaceLink(__NAMESPACE__);
$configNs = $apigen->classLinker(Config::class)->namespaceLink();

use Sphp\Stdlib\Events\EventInterface as EventInterface;

$eventNs = $apigen->classLinker(EventInterface::class)->namespaceLink();

use Sphp\I18n\Gettext\Translator;

$gettextNs = $apigen->classLinker(Translator::class)->namespaceLink();

use Sphp\Stdlib\Strings;

$typesNs = $apigen->classLinker(Strings::class)->namespaceLink();
echo <<<MD
##Introduction:

Core components are a collection of miscellaneous classes. These classes can be groupped into subnamespaces:

 * Configuration and error handling: $rootNs
 * Configuration: $configNs
 * Variable manipulation: $typesNs
 * Human language translation: $gettextNs
 * Event dispatching: $eventNs    
MD
;
