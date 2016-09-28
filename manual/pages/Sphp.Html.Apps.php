<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion;
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



CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Apps/Manual/LinkerInterface.php');

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Apps/misc.php');
CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Apps/SyntaxHighlighter.php');