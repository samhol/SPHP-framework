<?php

namespace Sphp\Html\Foundation;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Foundation for sites: <small>HTML front-end framework</small>
$ns

MD
);
//Manual\printPage('foundation-carousel');
//Manual\loadPage('Sphp.Html.Foundation.Sites');
Manual\printPage('intros/Foundation/orbit.php');
