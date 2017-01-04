<?php

namespace Sphp\Core;

use Sphp\Html\Apps\Manual\Apis;

$apigen = Apis::apigen();
$ns = $apigen->namespaceBreadGrumbs(__NAMESPACE__);

use Sphp\Core\Config\Config;
$rootNs = $apigen->classLinker(Comparable::class)->namespaceLink();
$configNs = $apigen->classLinker(Config::class)->namespaceLink();
use Sphp\Core\Events\EventInterface as EventInterface;
$eventNs = $apigen->classLinker(EventInterface::class)->namespaceLink();
use Sphp\Core\I18n\Gettext\Translator;
$gettextNs = $apigen->classLinker(Translator::class)->namespaceLink();
use Sphp\Core\Types\Strings  as Strings;
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
