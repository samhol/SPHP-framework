<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Apps\Manual\Apis as Apis;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$flexVideo = Apis::apigen()->classLinker(GridForm::class);
$mediaExample = \Sphp\Core\Util\FileUtils::executePhpToString(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/Flex.php');
$manLink = new \Sphp\Html\Foundation\F6\Buttons\HyperlinkButton("?page=Sphp.Html.Foundation.F6.Media", "Manual page", "_self");


echo <<<MD
##Foundation 6 Form components:

$ns
        
This namespace includes Foundation front-end framework based forms layouts and form components implemented in PHP.
Visual presentation of Foundation Forms is built with the Grid. These forms 
extend basic SPHP forms.

MD
;
use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;
$blockGrid = new BlockGrid();

$blockGrid->setBlockGrids(1, false
        )
        ->appendPhpFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Forms/GridForm.php')
        ->printHtml();
