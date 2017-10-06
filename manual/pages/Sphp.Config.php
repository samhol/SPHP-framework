<?php

namespace Sphp\Config;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$config = Apis::sami()->classLinker(Config::class);
$instanceMethod = $config->methodLink('instance', false);
\Sphp\Manual\parseDown(<<<MD
#APPLICATION CONFIGURATION{#Config}
$ns
  
##$config <small>a genereal configuration manager</small>{#Config_Config}

A $config object can be used to store any type of PHP variables. An application 
can have multiple named singleton configuration objects. These objects are 
accessible via a static  $instanceMethod method.
  
MD
);

CodeExampleBuilder::build('Sphp/Config/Config.php', 'text', false)
        ->setExamplePaneTitle('Canfiguration manager example')
        ->printHtml();

\Sphp\Manual\loadPage('Sphp.Config.Ini');
\Sphp\Manual\loadPage('Sphp.Config.PHPConfig');
