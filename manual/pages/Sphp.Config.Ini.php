<?php

namespace Sphp\Config;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$ini = Apis::sami()->classLinker(Ini::class);
$ini_set = Apis::phpManual()->functionLink('ini_set');
\Sphp\Manual\parseDown(<<<MD
##$ini <small>a runtime PHP configuration manager</small>{#Config_Ini}

$ini object contains a set of configuration options (see $ini_set in PHP manual). 
This set of options can be set and reset at any time during script execution. 

**Important:** Not all the available options can be changed using $ini. There is 
a list of all available options in the appendix.
 
MD
);

CodeExampleBuilder::build('Sphp/Config/Ini.php', 'text', false)
        ->setExamplePaneTitle('Runtime PHP INI manipulation example')
        ->printHtml();

