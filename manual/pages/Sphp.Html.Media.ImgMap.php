<?php

namespace Sphp\Html\Media\ImageMap;

use Sphp\Manual;

$map = Manual\api()->classLinker(Map::class);
$areaInterface = Manual\api()->classLinker(Area::class);
$rectangle = Manual\api()->classLinker(Rectangle::class);
$circle = Manual\api()->classLinker(Circle::class);
$polygon = Manual\api()->classLinker(Polygon::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
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

Manual\visualize('Sphp/Html/Media/ImageMap.php', null, true);
