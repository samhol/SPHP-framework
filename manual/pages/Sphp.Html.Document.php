<?php

namespace Sphp\Html;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion;
$documentClass = $api->classLinker(Document::class);
$htmlClass = $api->classLinker(Html::class);
echo $parsedown->text(<<<MD
##The $documentClass class
This class can be used to create the structure of any HTML document.
        
MD
); 
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Document.php", "html5", false);
echo $parsedown->text(<<<MD
The $documentClass class acts as a factory for basic HTML objects. Here are the 
grouped lists of the HTML5 components and the corresponding PHP types in Framework's HTML implementation.
MD
);
$load("htmlTagListArray.php");
