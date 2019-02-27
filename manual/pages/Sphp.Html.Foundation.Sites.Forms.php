<?php

namespace Sphp\Html\Foundation\Sites\Forms;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

//Document::html()->scripts()->appendSrc('manual/js/formTools.js');
\Sphp\Manual\md(<<<MD
#Foundation <small>Forms and input components</small>
        
$ns

MD
);

\Sphp\Manual\printPage('Sphp.Html.Foundation.Sites.Forms.GridForm');
\Sphp\Manual\printPage('Sphp.Html.Foundation.Sites.Forms.Inputs');
