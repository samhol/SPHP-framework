<?php

use Sphp\Manual\MVC\SideNavViewer;

$sidenawViewer = new SideNavViewer($manualLinks);
$sidenawViewer->getMenu()->addCssClass('sphp-sidenav');
$sidenawViewer->printHtml();
?>