<?php

namespace Sphp\Html;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$documentClass = Apis::sami()->classLinker(Document::class);
$htmlClass = Apis::sami()->classLinker(Html::class);
\Sphp\Manual\parseDown(<<<MD
##The $documentClass class
This class can be used to create the structure of any HTML document.
        
MD
);
CodeExampleBuilder::visualize('Sphp/Html/Document.php', "html5", false);
\Sphp\Manual\parseDown(<<<MD
The $documentClass class acts as a factory for basic HTML objects. Here are the 
grouped lists of the HTML5 components and the corresponding PHP types in Framework's HTML implementation.
MD
);

use Sphp\Stdlib\Reader\Yaml;

$data = (new Yaml())->fromFile('manual/yaml/document_data.yml');

//print_r($data);

namespace Sphp\Manual\MVC\TagListing;

$groups = new Groups($data);

echo new TagListAccordionGenerator($groups);
//echo "</pre>";

  
