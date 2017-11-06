<?php

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\Apps\Manual\Apis;

$grid = \Sphp\Manual\api()->classLinker(Grid::class);
$row = \Sphp\Manual\api()->classLinker(Row::class);
$col = \Sphp\Manual\api()->classLinker(Column::class);
$cols = \Sphp\Manual\api()->classLinker(Column::class, "Columns");

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$gridInterface = \Sphp\Manual\api()->classLinker(GridInterface::class);
$f_GridLink = Apis::foundation()->hyperlink('xy-grid.html', "Foundation Grid layout");
\Sphp\Manual\parseDown(<<<MD
#FOUNDATION <small>Grid and Block Grid layouts</small>
$ns	
This namespace contains $f_GridLink related interfaces and implementations.
        
		
The entire Grid is a **mobile-first** layout. So as a rule of thumb coding starts from small screens first, 
and larger devices will inherit those styles. Distinct features for larger screens can always be 
included when necessary.
MD
);

\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Grids.GridInterface');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Grids.RowInterface');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Grids.ColumnInterface');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Grids.BlockGrid');

