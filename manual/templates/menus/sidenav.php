<?php

use Sphp\Manual\MVC\SideNavViewer;

$sidenawViewer = new SideNavViewer($manualLinks, trim($_SERVER["REDIRECT_URL"], '/'));
$sidenawViewer->getMenu()->addCssClass('sphp-sidenav');
$sidenawViewer->printHtml();
?>
