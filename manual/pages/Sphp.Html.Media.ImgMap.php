<?php

namespace Sphp\Html\Media\ImageMap;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis as Apis;
$map  = Apis::apigen()->classLinker(Map::class);
$areaInterface  = Apis::apigen()->classLinker(AreaInterface::class);
$rectangle = Apis::apigen()->classLinker(Rectangle::class);
$circle = Apis::apigen()->classLinker(Circle::class);
$polygon = Apis::apigen()->classLinker(Polygon::class);
$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
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
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Media/ImageMap.php", false, true);