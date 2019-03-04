<?php

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Manual;

$tabs = Manual\api()->classLinker(Tabs::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
### The $tabs component
        
$ns

 > In interface design, a tabbed document interface (TDI) or Tab is a graphical 
   control element that allows multiple documents or panels to be contained 
   within a single window, using tabs as a navigational widget for switching 
   between sets of documents. It is an interface style most commonly associated 
   with web browsers, web applications, text editors, and preference panes, 
   with window managers, especially tiling window managers, being lesser 
   known examples.
   <cite class="wikipedia">[from Wikipedia](https://en.wikipedia.org/wiki/Tab_(GUI))</cite>

MD
);
CodeExampleAccordionBuilder::visualize('Sphp/Html/Foundation/Sites/Containers/Tabs/Tabs.php', null, false);
/*(new SyntaxHighlightingSingleAccordion())
        ->loadFromFile('Sphp/Html/Foundation/Sites/Containers/Tabs/Tabs.php')
        ->setPaneTitle("Tabs example code")
        ->printHtml();*/
include('Sphp/Html/Foundation/Sites/Containers/Tabs/Tabs.php');

