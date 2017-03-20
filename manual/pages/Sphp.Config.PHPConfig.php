<?php

namespace Sphp\Config;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$phpConfig = Apis::apigen()->classLinker(PHPConfig::class);

echo $parsedown->text(<<<MD
##$phpConfig OBJECT: <small>a runtime PHP configuration manager</small>{#Config_PHPConfig} 

$phpConfig object can handle basic runtime PHP environment configuration. Objects configuration 
settings can be reinitialized during script execution and thus a programmer can change the behaviour of the PHP 
environment by simply using multiple instances of $phpConfig.
        
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Config/PHPConfig.php", 'text', false))
        ->setExampleHeading("PHP environment manipulation example")
        ->printHtml();
