<?php

namespace Sphp\Html\Foundation\F6\Core;

$grid = $api->classLinker(Grid::class);
$row = $api->classLinker(Row::class);
$col = $api->classLinker(Column::class);
$cols = $api->getClassLink(Column::class, "Columns");
//$ns = $api->getNamespaceLink(__NAMESPACE__);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
$f_GridLink = $foundation->getComponentLink(Grid::class, "Foundation Grid layout");
echo $parsedown->text(<<<MD
#Foundation front-end framework
MD
);
$load("Sphp.Html.Foundation-orbit-intro.php");
