<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Manual;

$gridIf = Manual\api()->classLinker(GridInterface::class);

Manual\parseDown(<<<MD
##The $gridIf <small>and its implementations</small>

An implementation of a $gridIf is a container for horizontal Rows having columns. As default this 
framework supports a `12-column` flexible grid that can scale out to an arbitrary 
size (defined by the max-width of the row) that's also easily nested.

**IMPORTANT:** A Grid component itself without any content does not output any HTML into the document.
  
MD
);
Manual\example('Sphp/Html/Foundation/Sites/Grids/XY/Grid_fromArray.php', 'html5')
        ->setExamplePaneTitle('PHP code of a grid')
        ->setOutputSyntaxPaneTitle('HTML5 code of a grid')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();
