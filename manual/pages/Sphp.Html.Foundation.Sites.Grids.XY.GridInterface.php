<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Manual;

$gridIf = Manual\api()->classLinker(GridInterface::class);

$rowIf = Manual\api()->classLinker(RowInterface::class);
$colIf = Manual\api()->classLinker(Column::class);

Manual\md(<<<MD
##The $colIf <small>and its implementations</small>
		
A $colIf defines a single column of a $rowIf in a Grid layout.

MD
);
Manual\md(<<<MD
##The $rowIf <small>and its implementations</small>

A $rowIf defines a horizontal block containing vertical $colIf components. 
It forms a single row in a $gridIf layout, but it can be used as a individual component also.

MD
);
Manual\md(<<<MD
##The $gridIf <small>and its implementations</small>

An implementation of a $gridIf is a container for horizontal Rows having columns. As default this 
framework supports a `12-column` flexible grid that can scale out to an arbitrary 
size (defined by the max-width of the row) that's also easily nested.

  
MD
);
Manual\example('Sphp/Html/Foundation/Sites/Grids/XY/Grid.php', 'html5')
        ->setExamplePaneTitle('PHP code of a grid')
        ->setOutputSyntaxPaneTitle('HTML5 code of a grid')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();
