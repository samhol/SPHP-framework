<?php

namespace Sphp\Html;

use Sphp\Manual;

$documentClass = Manual\api()->classLinker(SphpDocument::class);
$htmlClass = Manual\api()->classLinker(Html::class);
Manual\md(<<<MD
##Component factories 
Framework has several Factory classes for various object types.
##The $documentClass class
This class can be used to create the structure of any HTML document.
        
MD
);

Manual\visualize('Sphp/Html/Document.php', 'html5', false);

Manual\printPage('Sphp.Html.Factory');

Manual\printPage('Sphp.Html.Forms.Inputs.Factory');
