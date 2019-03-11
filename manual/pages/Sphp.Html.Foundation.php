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
include 'Sphp/Html/Foundation/Sites/Adapters/Interchange.php';

//\Sphp\Manual\visualize('Sphp/Html/Foundation/Sites/Adapters/Interchange.php');
?>
<img data-interchange="[manual/svg/svg.php?name=crossbones, small], [manual/svg/svg.php?name=s-logo, medium], [manual/svg/svg.php?name=human-skull, large]">