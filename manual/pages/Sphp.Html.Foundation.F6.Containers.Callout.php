<?php

namespace Sphp\Html\Foundation\F6\Containers;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as ExampleAccordions;

$callout = $api->classLinker(Callout::class);
echo $parsedown->text(<<<MD
###The $callout component
		
$callout is a Foundation 6 based component that makes it possible to outline 
sections of a web page. The width of a $callout is controlled by the size of their 
container.
		
MD
);

ExampleAccordions::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/Callout.php');
