<?php

namespace Sphp\Html\Foundation\F6\Containers\Tabs;
use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as ExampleAccordions;

$tabs = $api->classLinker(Tabs::class);

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
###The $tabs component
$ns
The $tabs component makes it possible to navigate multiple documents in a single container.
$tabs can be used for switching between items in the container. This component has both horizontal and vertical layout.
MD
);
ExampleAccordions::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/Tabs/Tabs.php');
