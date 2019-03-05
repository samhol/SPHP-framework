<?php

namespace Sphp\Config;

use Sphp\Manual;

$ini = Manual\api()->classLinker(Ini::class);
$ini_set = Manual\php()->functionLink('ini_set');
$iniList = Manual\php()->hyperlink('ini.list.php', 'List of php.ini directives');
Manual\md(<<<MD
### $ini <small>is a runtime PHP ini manager</small>

$ini object contains a set of configuration options (see $ini_set in PHP manual). 
This set of options can be set and reset at any time during script execution. 

**Important:** Not all the available options can be changed using $ini. There is 
a list of all available options in the $iniList.
 
MD
);

Manual\example('Sphp/Config/Ini.php')
        ->setExamplePaneTitle('Runtime PHP INI manipulation example')
        ->printHtml();
