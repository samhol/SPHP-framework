<?php

namespace Sphp\Html\Apps;
use Sphp\Manual;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$photoAlbum = \Sphp\Manual\api()->classLinker(PhotoAlbum::class);
\Sphp\Manual\md(<<<MD
##The $photoAlbum component
MD
);
Manual\example("Sphp/Html/Apps/PhotoAlbum.php", null, false)->printHtml();
include_once("manual/examples/Sphp/Html/Apps/PhotoAlbum.php");
