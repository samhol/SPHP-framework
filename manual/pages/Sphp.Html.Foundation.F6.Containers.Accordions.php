<?php

namespace Sphp\Html\Foundation\F6\Containers\Accordions;


$ns = $api->namespaceLink(__NAMESPACE__);
$paneInterface = $api->classLinker(PaneInterface::class);
$accordion = $api->classLinker(Accordion::class);

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
        
##The $accordion container for $paneInterface components
$ns
>The graphical control element **accordion** is a vertically stacked list of items, 
such as labels or thumbnails. Each item can be "expanded" or "stretched" to reveal 
the content associated with that item. There can be zero expanded items, exactly 
one, or more than one item expanded at a time, depending on the configuration.
<cite>Wikipedia</cite>

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Containers/Accordions/Accordions.php');

/*$t = new SyntaxHighlightingSingleAccordion("PHP code");

$t->loadFromFile(EXAMPLE_DIR . 'Sphp/Html/Foundation/Content/Accordions.php');

$t->printHtml();*/

/*$ev = new ExampleAccordions(EXAMPLE_DIR . 'Sphp/Html/Foundation/Content/Accordions.php');
$ev->printHtml();*/
