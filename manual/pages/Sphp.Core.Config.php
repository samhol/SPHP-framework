<?php

namespace Sphp\Core\Config;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$config = Apis::apigen()->classLinker(Config::class);
$phpConfig = Apis::apigen()->classLinker(PHPConfig::class);
$boolLink = $php->typeLink('boolean');
$intLink = $php->typeLink('integer');
$floatLink = $php->typeLink('float');
$strLink = $php->typeLink('string');
$arrLink = $php->typeLink('array');
$arrayAccess = $php->classLinker(\ArrayAccess::class);
$path = $api->classLinker(\Sphp\Core\Path::class);
echo $parsedown->text(<<<MD
#APPLICATION CONFIGURATION DATA{#Config}
$ns
  
##$config OBJECT: <small>a genereal configuration manager</small>{#Config_Config}

A $config object can be used to store any type of data. $config class contains all user defined configuration domains.
A domain is actually a singelton $config instance and all domain instances can have own specific configuration settings.
  

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Config/Config.php", 'text', false);

$load('Sphp.Core.Config.Ini');
$load('Sphp.Core.Config.PHPConfig');
$load('Sphp.Core.Config.ErrorHandling');
