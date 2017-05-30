<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$gridIf = Apis::sami()->classLinker(GridInterface::class);
$grid = Apis::sami()->classLinker(Grid::class);
$row = Apis::sami()->classLinker(Row::class);
$rowIf = Apis::sami()->classLinker(RowInterface::class);
$colIf = Apis::sami()->classLinker(ColumnInterface::class);
$col = Apis::sami()->classLinker(Column::class);
$cols = Apis::sami()->classLinker(ColumnInterface::class, "Columns");
$gridsLnk = Apis::sami()->namespaceLink(__NAMESPACE__);
$f_GridLink = Apis::foundation()->getComponentLink(Grid::class, "Foundation Grid layout");

$codeExampleBuilder = new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Grids/Grid_fromArray.php', 'html5');


echo $parsedown->text(<<<MD
##The $colIf <small>and its implementations</small>
		
A $colIf defines a sigle column of a $rowIf in a Grid layout.

MD
);
$codeExampleBuilder->setPath('Sphp/Html/Foundation/Sites/Grids/Column.php')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();


