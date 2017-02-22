<?php

use Sphp\Manual\MVC\SideNavViewer;

$sidenawViewer = new SideNavViewer($manualLinks, filter_input(INPUT_GET, 'page', FILTER_SANITIZE_STRING));
$sidenawViewer->getMenu()->addCssClass('sphp-sidenav');
$sidenawViewer->printHtml();
?>
