<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$gridIf = \Sphp\Manual\api()->classLinker(GridInterface::class);
$grid = \Sphp\Manual\api()->classLinker(Grid::class);
$row = \Sphp\Manual\api()->classLinker(Row::class);
$rowIf = \Sphp\Manual\api()->classLinker(RowInterface::class);
$colIf = \Sphp\Manual\api()->classLinker(ColumnInterface::class);
$col = \Sphp\Manual\api()->classLinker(Column::class);
$cols = \Sphp\Manual\api()->classLinker(ColumnInterface::class, "Columns");
$gridsLnk = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__);
$f_GridLink = Apis::foundation()->hyperlink('xy-grid.html', 'Foundation XY Grid layout');

$codeExampleBuilder = new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Grids/Grid_fromArray.php', 'html5');


\Sphp\Manual\parseDown(<<<MD
##The $colIf <small>and its implementations</small>
		
A $colIf defines a single column of a $rowIf in a Grid layout.

MD
);
$codeExampleBuilder->setPath('Sphp/Html/Foundation/Sites/Grids/Column.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();


