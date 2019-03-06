<?php

use Sphp\Html\Foundation\Sites\Media\Orbit\Orbit;
use Sphp\Html\Tags;

$orbit = new Orbit();
$orbit->addCssClass('sphp', 'manual', 'intro-orbit', 'html');
$orbit->autoplay(false);
$orbit->attributes()->setAttribute('data-options', 'animInFromLeft:fade-in; animInFromRight:fade-in; animOutToLeft:fade-out; animOutToRight:fade-out;');

$path = realpath('manual/pages/intros/HTML/slides/');
$slides = $orbit->slides();

$slides->append(Tags::section()->appendMdFile("$path/html.php"))->addCssClass('html');
$slides->append(Tags::section()->appendMdFile("$path/js.php"))->addCssClass('js');
$slides->append(Tags::section()->appendMdFile("$path/scss.md"))->addCssClass('sass');
$slides->append(Tags::section()->appendMdFile("$path/svg.php"))->addCssClass('svg');
$orbit->printHtml();
