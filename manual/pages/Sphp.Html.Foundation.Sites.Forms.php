<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Document;
use Sphp\Html\Apps\Manual\Apis;
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);

Document::html()->scripts()->appendSrc('manual/js/formTools.js');
echo $parsedown->text(<<<MD
#Foundation for sites: <small>Forms and input components</small>
        
$ns

MD
);

$load('Sphp.Html.Foundation.Sites.Forms.GridForm');
$load('Sphp.Html.Foundation.Sites.Forms.Inputs');
