<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\Tags;
$orbit = new Orbit();
$orbit->addCssClass('sphp', 'manual', 'intro-orbit', 'html');
$orbit->setAnimIn('fade-in')
        ->setAnimOut('fade-out')
        ->pauseOnHover(true);
$orbit->addCssClass('intro');
$slides = $orbit->slides();
$slides->append(Tags::section()->appendMdFile('manual/pages/Sphp-intro/introduction.php'));
$slides->append(Tags::section()->appendMdFile('manual/pages/Sphp-intro/libraries.php'));
$orbit->setActive(0);
$orbit->printHtml();

var_dump($path);
var_dump($_GET);