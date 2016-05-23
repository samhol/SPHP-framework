<?php

namespace Sphp\Html\Foundation\Content;
use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$ns = $api->getNamespaceLink(__NAMESPACE__);
$tabs = $api->getClassLink(Tabs::class);

echo $parsedown->text(<<<MD
###The $tabs component
		
The $tabs component makes it possible to navigate multiple documents in a single container.
$tabs can be used for switching between items in the container. This component has both horizontal and vertical layout.
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Content/Tabs.php');