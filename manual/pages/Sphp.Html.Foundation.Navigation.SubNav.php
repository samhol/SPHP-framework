<?php

namespace Sphp\Html\Foundation\Navigation\SubNav;

$subNav = $api->getClassLink(SubNav::class);
$f_SubNav = $foundation->getComponentLink(SubNav::class);
echo $parsedown->text(<<<MD
##The $subNav component

$subNav implements Foundation $f_SubNav component. It is a navigation panel
designated for moving between different states of a page.
MD
);
$exampleViewer(EXAMPLE_DIR . 'Sphp/Html/Foundation/Navigation/SubNav.php', 2);
