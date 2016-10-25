<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Div;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);

$exampleDiv = (new Div())->addCssClass("example-area")
        ->appendPhpFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/GridForm.php');
echo <<<MD
##Foundation Form components:

$ns

$exampleDiv
MD
;
