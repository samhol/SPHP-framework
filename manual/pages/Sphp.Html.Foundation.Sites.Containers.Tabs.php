<?php

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$tabs = Apis::apigen()->classLinker(Tabs::class);

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
###The $tabs component
$ns
The $tabs component makes it possible to navigate multiple documents in a single container.
$tabs can be used for switching between items in the container. This component has both horizontal and vertical layout.
MD
);
(new SyntaxHighlightingSingleAccordion())
        ->loadFromFile('Sphp/Html/Foundation/F6/Containers/Tabs/Tabs.php')
        ->setPaneTitle("Tabs example code")
        ->printHtml();
include('Sphp/Html/Foundation/F6/Containers/Tabs/Tabs.php');

