<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$photoAlbum = \Sphp\Manual\api()->classLinker(PhotoAlbum::class);
\Sphp\Manual\md(<<<MD
##The $photoAlbum component
MD
);
$syntax = (new CodeExampleAccordionBuilder())->loadFromFile("Sphp/Html/Apps/PhotoAlbum.php");
include_once("Sphp/Html/Apps/PhotoAlbum.php");
