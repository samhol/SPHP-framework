<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$ns = $api->namespaceLink(__NAMESPACE__);
$photoAlbum = $api->classLinker(PhotoAlbum::class);
echo $parsedown->text(<<<MD
##The $photoAlbum component
MD
);
$syntax = (new CodeExampleAccordion())->loadFromFile(EXAMPLE_DIR . "Sphp/Html/Apps/PhotoAlbum.php");
include_once(EXAMPLE_DIR . "Sphp/Html/Apps/PhotoAlbum.php");
