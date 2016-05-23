<?php

namespace Sphp\Html\Foundation\Content;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$ns = $api->getNamespaceLink(__NAMESPACE__);
$accordion = $api->getClassLink(Pane::class);
$accordions = $api->getClassLink(Accordion::class);

echo $parsedown->text(<<<MD

###The $accordions component

The $accordions component acts as a container for $accordion components. These components 
are used to expand and collapse content that is broken into logical sections.
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/Content/Accordions.php');
