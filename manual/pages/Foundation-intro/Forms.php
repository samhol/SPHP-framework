<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Div;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

$exampleDiv = (new Div())->addCssClass("example-area")
        ->appendPhpFile('Sphp/Html/Foundation/Sites/Forms/GridForm.php');
echo <<<MD
##Foundation Form components:

$ns

$exampleDiv
MD
;
