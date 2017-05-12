<?php

namespace Sphp\Config;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$config = Apis::sami()->classLinker(Config::class);

echo $parsedown->text(<<<MD
#APPLICATION CONFIGURATION{#Config}
$ns
  
##$config OBJECT: <small>a genereal configuration manager</small>{#Config_Config}

A $config object can be used to store any type of data. $config class contains all user defined configuration domains.
A domain is actually a singelton $config instance and all domain instances can have own specific configuration settings.
  

MD
);

CodeExampleBuilder::visualize('Sphp/Config/Config.php', 'text', false);

$load('Sphp.Config.Ini');
$load('Sphp.Config.PHPConfig');
$load('Sphp.Config.ErrorHandling');
