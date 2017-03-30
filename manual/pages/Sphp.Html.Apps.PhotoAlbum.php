<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$ns = $api->namespaceLink(__NAMESPACE__);
$photoAlbum = $api->classLinker(PhotoAlbum::class);
echo $parsedown->text(<<<MD
##The $photoAlbum component
MD
);
$syntax = (new CodeExampleBuilder())->loadFromFile("Sphp/Html/Apps/PhotoAlbum.php");
include_once("Sphp/Html/Apps/PhotoAlbum.php");
