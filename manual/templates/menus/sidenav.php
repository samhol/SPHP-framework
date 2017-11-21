<?php

use Sphp\Manual\MVC\SideNavViewer;

$redirect = filter_input(INPUT_SERVER, 'REDIRECT_URL', FILTER_SANITIZE_URL);
$sidenawViewer = new SideNavViewer($manualLinks, trim($redirect, '/'));
$sidenawViewer->getMenu()->addCssClass('sphp-sidenav');
$sidenawViewer->printHtml();
