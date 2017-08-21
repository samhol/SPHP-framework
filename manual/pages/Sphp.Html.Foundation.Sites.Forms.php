<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Document;
use Sphp\Html\Apps\Manual\Apis;
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

Document::html()->scripts()->appendSrc('manual/js/formTools.js');
\Sphp\Manual\parseDown(<<<MD
#Foundation for sites: <small>Forms and input components</small>
        
$ns

MD
);

\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Forms.GridForm');
\Sphp\Manual\loadPage('Sphp.Html.Foundation.Sites.Forms.Inputs');
