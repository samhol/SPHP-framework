<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */
use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$f_GridLink = Manual\foundation()->XY_grid;
Manual\md(<<<MD
# Foundation <small>Grid and Containers</small>
	
The entire Grid is a **mobile-first** layout. So as a rule of thumb coding starts from small screens first, 
and larger devices will inherit those styles. Distinct features for larger screens can always be 
included when necessary.
MD
);
Manual\printPage('Sphp.Html.Foundation.Sites.Grids.XY');
Manual\printPage('Sphp.Html.Foundation.Sites.Containers');
