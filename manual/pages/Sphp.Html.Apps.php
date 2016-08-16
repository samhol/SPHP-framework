<?php

namespace Sphp\Html\Apps;

$ns = $api->namespaceLink(__NAMESPACE__);
echo $parsedown->text(<<<MD
#MISCELLANEOUS HTML COMPONENTS AND APPLICATIONS: $ns namespace

MD
);
//$load("Sphp.Html.Apps.PhotoAlbum.php");
$load("Sphp.Html.Apps.SyntaxHighlighter.php");
$load("Sphp.Html.Apps.SingleAccordion.php");
