<?php

namespace Sphp\Config;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$config = Manual\api()->classLinker(Config::class);
$instanceMethod = $config->methodLink('instance', false);
Manual\md(<<<MD
#Application configuration
$ns
  
##$config <small>a genereal configuration manager</small>

A $config object can be used to store any type of PHP variables. An application 
can have multiple named singleton configuration objects. These objects are 
accessible via a static  $instanceMethod method.
  
MD
);

Manual\example('Sphp/Config/Config.php', 'text', false)
        ->setExamplePaneTitle('Canfiguration manager example')
        ->printHtml();

Manual\loadPage('Sphp.Config.PHP');
