<?php

namespace Sphp\Html;

use Sphp\Manual;

$factory = Manual\api()->classLinker(Factory::class);
Manual\parseDown(<<<MD
##The $factory class: <small>a factory for basic HTML components</small>

Here are grouped lists of the HTML5 components and the corresponding PHP types.
MD
);

use Sphp\Stdlib\Parser;

$data = Parser::getReaderFor('yml')->fromFile('manual/yaml/document_data.yml');

//print_r($data);

namespace Sphp\Manual\MVC\TagListing;

$groups = new Groups($data);

echo new TagListAccordionGenerator($groups);
//echo "</pre>";

  
