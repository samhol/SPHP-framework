<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Manual;

$factory = Manual\api()->classLinker(Input::class);
Manual\parseDown(<<<MD
##The $factory class: <small>a factory for basic HTML components</small>

Here are grouped lists of the HTML5 components and the corresponding PHP types.
MD
);

use Sphp\Stdlib\Reader\Yaml;

$data = (new Yaml())->fromFile('manual/yaml/Sphp.Html.Forms.Inputs.Factory.yml');

//print_r($data);

namespace Sphp\Manual\MVC\TagListing;

$groups = new Groups($data);

echo new TagListAccordionGenerator($groups);
//echo "</pre>";

  
