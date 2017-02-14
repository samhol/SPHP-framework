<?php

namespace Sphp\Core\Config;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$config = $api->classLinker(Config::class);
$phpConfig = $api->classLinker(PHPConfig::class);
$toolsLink = $api->namespaceLink(__NAMESPACE__);
$boolLink = $php->typeLink('boolean');
$intLink = $php->typeLink('integer');
$floatLink = $php->typeLink('float');
$strLink = $php->typeLink('string');
$arrLink = $php->typeLink('array');
$arrayAccess = $php->classLinker(\ArrayAccess::class);
$path = $api->classLinker(\Sphp\Core\Path::class);
echo $parsedown->text(<<<MD
#APPLICATION CONFIGURATION DATA
        
##$config object as a genereal configuration manager

A $config object can be used to store any type of data. $config class contains all user defined configuration domains.
A domain is actually a singelton $config instance and all domain instances can have own specific configuration settings.
  
Every $config instance includes also instances of $phpConfig and $path.

MD
);

$ini = $api->classLinker(Ini::class);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Config/Config.php", 'text', false);
echo $parsedown->text(<<<MD
##$ini object: <small>a runtime PHP configuration manager</small>{#Config_Ini}

$ini Sets the value of the given configuration option. The configuration option will keep this new value during the script's execution, and will be restored at the script's ending..
        
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Config/Ini.php", 'text', false))
        ->setExampleHeading("PHP environment manipulation example")
        ->printHtml();
echo $parsedown->text(<<<MD
##$phpConfig object as a runtime PHP configuration manager 

$phpConfig object can handle basic runtime PHP environment configuration. Objects configuration 
settings can be reinitialized during script execution and thus a programmer can change the behaviour of the PHP 
environment by simply using multiple instances of $phpConfig.
        
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Config/PHPConfig.php", 'text', false))
        ->setExampleHeading("PHP environment manipulation example")
        ->printHtml();


