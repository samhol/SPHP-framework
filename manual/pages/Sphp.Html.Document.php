<?php

namespace Sphp\Html;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$documentClass = Apis::apigen()->classLinker(Document::class);
$htmlClass = Apis::apigen()->classLinker(Html::class);
echo $parsedown->text(<<<MD
##The $documentClass class
This class can be used to create the structure of any HTML document.
        
MD
);
CodeExampleBuilder::visualize("Sphp/Html/Document.php", "html5", false);
echo $parsedown->text(<<<MD
The $documentClass class acts as a factory for basic HTML objects. Here are the 
grouped lists of the HTML5 components and the corresponding PHP types in Framework's HTML implementation.
MD
);
$load("htmlTagListArray.php");
