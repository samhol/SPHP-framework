<?php

namespace Sphp\Config;

use Sphp\Manual;

$phpConfig = Manual\api()->classLinker(PHPConfig::class);
$ini = Manual\api()->classLinker(PHPIni::class);

Manual\md(<<<MD
###$phpConfig <small> is a runtime PHP environment manager </small>
       
$phpConfig object can handle basic runtime PHP environment configuration. Objects configuration 
settings can be reinitialized during script execution and thus a programmer can change the behaviour of the PHP 
environment by simply using multiple instances of $phpConfig.
        
MD
);

Manual\example("Sphp/Config/PHPConfig.php", 'text', false)
        ->setExamplePaneTitle('PHP environment manipulation example')
        ->printHtml();
