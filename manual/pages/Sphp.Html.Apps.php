<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#MISCELLANEOUS HTML COMPONENTS AND APPLICATIONS
        
$ns
MD
);
//$load("Sphp.Html.Apps.PhotoAlbum.php");
$load("Sphp.Html.Apps.SyntaxHighlighter.php");
$load("Sphp.Html.Apps.SingleAccordion.php");



CodeExampleBuilder::visualize('Sphp/Html/Apps/Manual/LinkerInterface.php');

CodeExampleBuilder::visualize('Sphp/Html/Apps/misc.php');
CodeExampleBuilder::visualize('Sphp/Html/Apps/SyntaxHighlighter.php');