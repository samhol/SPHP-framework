<?php

namespace Sphp\Html\Apps;

$ns = $api->getNamespaceLink(__NAMESPACE__);
$photoAlbum = $api->classLinker(PhotoAlbum::class);
echo $parsedown->text(<<<MD
##The $photoAlbum component
MD
);
$syntax = (new SyntaxHighlightingAccordion())->loadFromFile(EXAMPLE_DIR . "Sphp/Html/Apps/PhotoAlbum.php");
include_once(EXAMPLE_DIR . "Sphp/Html/Apps/PhotoAlbum.php");
