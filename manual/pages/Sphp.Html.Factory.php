<?php

namespace Sphp\Html;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$factory = Manual\api()->classLinker(Tags::class);
Manual\md(<<<MD
##The $factory class: <small>a factory for basic HTML components</small>
$ns
MD
);

Manual\visualize('Sphp/Html/TagFactory.php', 'html5', true);
Manual\md(<<<MD
###Grouped lists of the HTML5 tags and the corresponding PHP types.
MD
);
use Sphp\Stdlib\Parsers\Parser;

$data = Parser::getReaderFor('yml')->readFromFile('manual/yaml/document_data.yml');

//print_r($data);

namespace Sphp\Manual\MVC\FactoryViews;

$groups = new Groups($data);

echo new TagListAccordionGenerator($groups);
//echo "</pre>";

  
