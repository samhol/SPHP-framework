<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

//$img = $api->classLinker(Img::class);
$img = Apis::apigen()->classLinker(Img::class);
$size = $api->classLinker(Size::class);
$fig = $api->classLinker(Figure::class);
$figCaption = $api->classLinker(FigCaption::class);
echo $parsedown->text(<<<MD
##The $img and the $fig components

The $img component is an implementation of the HTML {$w3schools->tag("img")} element. 
$img provides some static factory methods for showing resized image components. 
		
**List of factory methods creating new resized instances of the $img:**

* {$img->method("scaleToFit")}: scales the original image file to fit the given $size object while constraining proportions
* {$img->method("widen")}: resizes the original image file to match the given $size object
* {$img->method("heighten")}: resizes the original image to given height, constraining proportions
* {$img->method("scale")}: resizes the original image by aplying the given ratio to both sides
* {$img->method("resize")}: resizes the original image file to match the given $size object
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Media/Img.php", false, true);

echo $parsedown->text(<<<MD
The $fig component implements the {$w3schools->tag("figure")} tag. 
A $fig component consists of an $img component and an optional $figCaption component.

A $fig component specifies a self-contained content. While its content is related 
to the main flow, its position is independent of the main flow, and if removed 
it should not affect the flow of the document.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Media/Figure.php", false, true);

