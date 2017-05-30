<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Manual\Apis;

$grid = Apis::sami()->classLinker(Grid::class);
$row = Apis::sami()->classLinker(Row::class);
$col = Apis::sami()->classLinker(Column::class);
$cols = Apis::sami()->classLinker(Column::class, "Columns");

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$gridInterface = Apis::sami()->classLinker(GridInterface::class);
$f_GridLink = Apis::foundation()->docsLink('grid.html', "Foundation Grid layout");
echo $parsedown->text(<<<MD
#FOUNDATION <small>Grid and Block Grid layouts</small>
$ns	
This namespace contains $f_GridLink related interfaces and implementations.
        
		
The entire Grid is a **mobile-first** layout. So as a rule of thumb coding starts from small screens first, 
and larger devices will inherit those styles. Distinct features for larger screens can always be 
included when necessary.
MD
);

$load('Sphp.Html.Foundation.Sites.Grids.GridInterface');
$load('Sphp.Html.Foundation.Sites.Grids.RowInterface');
$load('Sphp.Html.Foundation.Sites.Grids.ColumnInterface');
$load('Sphp.Html.Foundation.Sites.Grids.BlockGrid');

