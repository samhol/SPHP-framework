<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Div;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$exampleDiv = (new Div())->addCssClass("example-area")
        ->appendPhpFile('manual/examples/Sphp/Html/Foundation/Sites/Forms/Inputs/InputColumnInterface.php');
echo <<<MD
##Foundation Form components:

$ns

$exampleDiv
MD
;
