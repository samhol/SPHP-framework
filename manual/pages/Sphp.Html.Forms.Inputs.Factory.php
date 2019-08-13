<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Manual;

$factory = Manual\api()->classLinker(FormControls::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\md(<<<MD
##The $factory factory: <small>a factory for HTML form components</small>
$ns
Here are grouped lists of the HTML5 components and the corresponding PHP types.
MD
);

use Sphp\Stdlib\Parsers\ParseFactory;

$data = ParseFactory::fromFile('manual/yaml/Sphp.Html.Forms.Inputs.Factory.yml');
//echo "<pre>";
//print_r($data);

namespace Sphp\Manual\MVC\FactoryViews;

$groups = new Groups($data);
/* foreach ($groups as $group) {
  foreach ($group as $item) {
  echo implode('|',$item->toArray())."\n";
  }
  }
  echo "</pre>"; */

echo new TagListAccordionGenerator($groups);
//echo "</pre>";

  
