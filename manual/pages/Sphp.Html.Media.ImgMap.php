<?php

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$map  = Apis::sami()->classLinker(Map::class);
$areaInterface  = Apis::sami()->classLinker(AreaInterface::class);
$rectangle = Apis::sami()->classLinker(Rectangle::class);
$circle = Apis::sami()->classLinker(Circle::class);
$polygon = Apis::sami()->classLinker(Polygon::class);
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
##HTML Imagemap components
$ns
        
 * $map defines a client-side image-map
 * $areaInterface defines an area inside an image-map:
   * $rectangle for a rectangular region
   * $circle for a circular region
   * $polygon for a polygonal region
        
A $map object is a container for $areaInterface components
MD
);
CodeExampleBuilder::visualize("Sphp/Html/Media/ImageMap.php", false, true);
