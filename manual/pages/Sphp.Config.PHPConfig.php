<?php

namespace Sphp\Config;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$phpConfig = Apis::sami()->classLinker(PHPConfig::class);

\Sphp\Manual\parseDown(<<<MD
##$phpConfig <small>a runtime PHP configuration manager</small>{#Config_PHPConfig} 

$phpConfig object can handle basic runtime PHP environment configuration. Objects configuration 
settings can be reinitialized during script execution and thus a programmer can change the behaviour of the PHP 
environment by simply using multiple instances of $phpConfig.
        
MD
);

(new CodeExampleBuilder("Sphp/Config/PHPConfig.php", 'text', false))
        ->setExamplePaneTitle('PHP environment manipulation example')
        ->printHtml();
