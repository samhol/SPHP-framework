<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#MISCELLANEOUS HTML COMPONENTS AND APPLICATIONS
        
$ns
MD
);

\Sphp\Manual\loadPage('Sphp.Html.Apps.SyntaxHighlighter');
\Sphp\Manual\loadPage('Sphp.Html.Apps.SingleAccordion');



CodeExampleAccordionBuilder::visualize('Sphp/Html/Apps/Manual/LinkerInterface.php');

CodeExampleAccordionBuilder::visualize('Sphp/Html/Apps/misc.php');
CodeExampleAccordionBuilder::visualize('Sphp/Html/Apps/SyntaxHighlighter.php');
