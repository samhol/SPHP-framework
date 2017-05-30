<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$gridIf = Apis::sami()->classLinker(GridInterface::class);
$htmlCont = Apis::sami()->classLinker(\Sphp\Html\Container::class);
$grid = Apis::sami()->classLinker(Grid::class);
$row = Apis::sami()->classLinker(Row::class);
$rowIf = Apis::sami()->classLinker(RowInterface::class);
$colIf = Apis::sami()->classLinker(ColumnInterface::class);
$col = Apis::sami()->classLinker(Column::class);
$cols = Apis::sami()->classLinker(ColumnInterface::class, "Columns");
$gridsLnk = Apis::sami()->namespaceLink(__NAMESPACE__);
$f_GridLink = Apis::foundation()->getComponentLink(Grid::class, "Foundation Grid layout");
echo $parsedown->text(<<<MD
##The $gridIf <small>and its implementations</small>

An implementation of a $gridIf is a container for horizontal Rows having columns. As default this 
framework supports a `12-column` flexible grid that can scale out to an arbitrary 
size (defined by the max-width of the row) that's also easily nested.

**IMPORTANT:** A Grid component itself without any content does not output any HTML into the document.
  
MD
);
$codeExampleBuilder = new CodeExampleBuilder('Sphp/Html/Foundation/Sites/Grids/Grid_fromArray.php', 'html5');

$codeExampleBuilder
        ->setExamplePaneTitle('PHP code of a grid')
        ->setOutputSyntaxPaneTitle('HTML5 code of a grid')
        ->buildAccordion()
        ->addCssClass('grid-example')
        ->printHtml();
