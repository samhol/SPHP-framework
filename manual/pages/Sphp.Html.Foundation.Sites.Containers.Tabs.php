<?php

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Manual;

$tabs = Manual\api()->classLinker(Tabs::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
###The $tabs component
$ns
The $tabs component makes it possible to navigate multiple documents in a single container.
$tabs can be used for switching between items in the container. This component has both horizontal and vertical layout.
MD
);
CodeExampleAccordionBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/Tabs/Tabs.php', null, false);
/*(new SyntaxHighlightingSingleAccordion())
        ->loadFromFile('Sphp/Html/Foundation/Sites/Containers/Tabs/Tabs.php')
        ->setPaneTitle("Tabs example code")
        ->printHtml();*/
include('Sphp/Html/Foundation/Sites/Containers/Tabs/Tabs.php');

