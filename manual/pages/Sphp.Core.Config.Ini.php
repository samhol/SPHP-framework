<?php

namespace Sphp\Config;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$ini = Apis::apigen()->classLinker(Ini::class);
$ini_set = Apis::phpManual()->functionLink('ini_set');
echo $parsedown->text(<<<MD
##$ini OBJECT: <small>a runtime PHP configuration manager</small>{#Config_Ini}

$ini object contains a set of configuration options (see $ini_set in PHP manual). This set of options can be set and reset at any time during script execution. keep this new value during the script's execution, and will be restored at the script's ending..

**Important:** Not all the available options can be changed using $ini. There is a list of all available options in the appendix.
 
MD
);

(new CodeExampleAccordion(EXAMPLE_DIR . "Sphp/Core/Config/Ini.php", 'text', false))
        ->setExampleHeading("PHP INI setting")
        ->printHtml();



