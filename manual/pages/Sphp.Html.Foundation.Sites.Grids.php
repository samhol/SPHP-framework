<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Manual;

$grid = Manual\api()->classLinker(Grid::class);
$row = Manual\api()->classLinker(Row::class);
$col = Manual\api()->classLinker(Column::class);
$cols = Manual\api()->classLinker(Column::class, 'Columns');

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$gridInterface = Manual\api()->classLinker(GridInterface::class);
$f_GridLink = Apis::foundation()->hyperlink('xy-grid.html', "Foundation Grid layout");
Manual\parseDown(<<<MD
#FOUNDATION <small>Grid and Block Grid layouts</small>
$ns	
This namespace contains $f_GridLink related interfaces and implementations.
        
		
The entire Grid is a **mobile-first** layout. So as a rule of thumb coding starts from small screens first, 
and larger devices will inherit those styles. Distinct features for larger screens can always be 
included when necessary.
MD
);

Manual\loadPage('Sphp.Html.Foundation.Sites.Grids.GridInterface');
Manual\loadPage('Sphp.Html.Foundation.Sites.Grids.RowInterface');
Manual\loadPage('Sphp.Html.Foundation.Sites.Grids.ColumnInterface');
Manual\loadPage('Sphp.Html.Foundation.Sites.Grids.BlockGrid');


