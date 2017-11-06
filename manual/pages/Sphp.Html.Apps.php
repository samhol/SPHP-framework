<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#MISCELLANEOUS HTML COMPONENTS AND APPLICATIONS
        
$ns
MD
);

\Sphp\Manual\loadPage('Sphp.Html.Apps.SyntaxHighlighter');
\Sphp\Manual\loadPage('Sphp.Html.Apps.SingleAccordion');



CodeExampleBuilder::visualize('Sphp/Html/Apps/Manual/LinkerInterface.php');

CodeExampleBuilder::visualize('Sphp/Html/Apps/misc.php');
CodeExampleBuilder::visualize('Sphp/Html/Apps/SyntaxHighlighter.php');