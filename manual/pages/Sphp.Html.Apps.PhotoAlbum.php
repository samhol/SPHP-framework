<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$photoAlbum = \Sphp\Manual\api()->classLinker(PhotoAlbum::class);
\Sphp\Manual\parseDown(<<<MD
##The $photoAlbum component
MD
);
$syntax = (new CodeExampleBuilder())->loadFromFile("Sphp/Html/Apps/PhotoAlbum.php");
include_once("Sphp/Html/Apps/PhotoAlbum.php");
