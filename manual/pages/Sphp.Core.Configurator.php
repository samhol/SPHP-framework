<?php

namespace Sphp\Core;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$config = $api->classLinker(Configuration::class);
$phpConfig = $api->classLinker(PHPConfiguration::class);
$toolsLink = $api->namespaceLink(__NAMESPACE__);
$boolLink = $php->typeLink("boolean");
$intLink = $php->typeLink("integer");
$floatLink = $php->typeLink("float");
$strLink = $php->typeLink("string");
$arrLink = $php->typeLink("array");
$arrayAccess = $php->classLinker(\ArrayAccess::class);
echo $parsedown->text(<<<MD
##$phpConfig object as a runtime PHP configuration manager 

$phpConfig object can handle basic runtime PHP environment configuration. Objects configuration 
settings can be reinitialized during script execution and thus a programmer can change the behaviour of the PHP 
environment by simply using multiple instances of $phpConfig.
        
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/PHPConfigurator.php", "text", false))
        ->setExampleHeading("PHP environment manipulation example")
        ->printHtml();

$pathFinder = $api->classLinker(PathFinder::class);
echo $parsedown->text(<<<MD

##$config object as a genereal configuration manager

A $config object can be used to store any type of data. $config class contains all user defined configuration domains.
A domain is actually a singelton $config instance and all domain instances can have own specific configuration settings.
  
Every $config instance includes also instances of $phpConfig and $pathFinder.

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Configurator.php", "text", false);

