<?php

namespace Sphp\Html\Foundation\Navigation\TopBar;

$navi = (new TopBar("TopBar"))
        ->useGridWidth();

$packages = (new DropDownMenu("Search engines"))
        ->appendLink("http://www.ask.com/", "Google", "_blank")
        ->appendLabel("from Google")
        ->appendSubmenu(
        (new DropDownMenu("Submenu 1"))
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLabel("separator:", TRUE)
        ->appendLink("http://www.yahoo.com/", "Yahoo", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank"));

$subMenu = (new DropDownMenu("More google"))
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendSubmenu((new DropDownMenu("Submenu 1"))
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLabel("separator:", TRUE)
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank"));
$subMenu->appendLink("http://www.google.com/", "Google", "_blank");
$packages->append($subMenu);

$navi->left()->appendDivider()->append($packages)->appendDivider();
$navi->right()
        ->appendButtonLink("https://github.com/samhol/SPH-framework", "GitHub", "_blank")
        ->appendButtonLink("https://github.com/samhol/SPH-framework/releases", "DOWNLOAD", "_blank");
$navi->printHtml();
?>