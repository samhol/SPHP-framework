<?php

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Html\Tags;

$orbit = new Orbit();
$orbit->addCssClass('sphp', 'manual', 'intro-orbit');
$orbit->autoplay(false);
$orbit->setAnimIn('fade-in');
$orbit->setAnimOut('fade-out');

$path = realpath('manual/pages/intros/Foundation/slides/');
$slides = $orbit->slides();

$slides->append(Tags::section()->appendMdFile("$path/front-slide.php"))->addCssClass('foundation');
$slides->append(Tags::section()->appendMdFile("$path/Buttons.php"))->addCssClass('foundation');
$slides->append(Tags::section()->appendMdFile("$path/Forms.php"))->addCssClass('foundation');
$slides->append(Tags::section()->appendMdFile("$path/Grids.php"))->addCssClass('foundation');
$slides->append(Tags::section()->appendMdFile("$path/Media.php"))->addCssClass('foundation');
$slides->append(Tags::section()->appendMdFile("$path/Navigation.php"))->addCssClass('foundation');
$orbit->printHtml();
