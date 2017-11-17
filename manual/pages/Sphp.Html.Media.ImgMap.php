<?php

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
$map  = \Sphp\Manual\api()->classLinker(Map::class);
$areaInterface  = \Sphp\Manual\api()->classLinker(AreaInterface::class);
$rectangle = \Sphp\Manual\api()->classLinker(Rectangle::class);
$circle = \Sphp\Manual\api()->classLinker(Circle::class);
$polygon = \Sphp\Manual\api()->classLinker(Polygon::class);
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
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
CodeExampleBuilder::visualize('Sphp/Html/Media/ImageMap.php', null, true);
