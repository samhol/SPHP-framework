<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Div;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

$exampleDiv = (new Div())->addCssClass("example-area")
        ->appendPhpFile('manual/examples/Sphp/Html/Foundation/Sites/Forms/Inputs/InputColumnInterface.php');
echo <<<MD
##Foundation Form components:

$ns

$exampleDiv
MD
;
