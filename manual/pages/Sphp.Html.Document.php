<?php

namespace Sphp\Html;

use Sphp\Manual;

$documentClass = Manual\api()->classLinker(Document::class);
$htmlClass = Manual\api()->classLinker(Html::class);
Manual\md(<<<MD
##Component factories 
Framework has several Factory classes for various object types.
##The $documentClass class
This class can be used to create the structure of any HTML document.
        
MD
);

Manual\visualize('Sphp/Html/Document.php', 'html5', false);

Manual\loadPage('Sphp.Html.Factory');

Manual\loadPage('Sphp.Html.Forms.Inputs.Factory');
