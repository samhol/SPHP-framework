<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#MISCELLANEOUS HTML COMPONENTS AND APPLICATIONS
        
$ns
MD
);

$load('Sphp.Html.Apps.SyntaxHighlighter');
$load('Sphp.Html.Apps.SingleAccordion');



CodeExampleBuilder::visualize('Sphp/Html/Apps/Manual/LinkerInterface.php');

CodeExampleBuilder::visualize('Sphp/Html/Apps/misc.php');
CodeExampleBuilder::visualize('Sphp/Html/Apps/SyntaxHighlighter.php');