<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$img = $api->classLinker(Img::class);
$size = $api->classLinker(Size::class);
$fig = $api->getClassLink(Figure::class);
$figCaption = $api->getClassLink(FigCaption::class);
echo $parsedown->text(<<<MD
##The $img and the $fig components

The $img component is an implementation of the HTML {$w3schools->getTagLink("img")} element. 
$img provides some static factory methods for showing resized image components. 
		
**List of factory methods creating new resized instances of the $img:**

* {$img->method("scaleToFit", FALSE)}: scales the original image file to fit the given $size object while constraining proportions
* {$img->method("widen", FALSE)}: resizes the original image file to match the given $size object
* {$img->method("heighten", FALSE)}: resizes the original image to given height, constraining proportions
* {$img->method("scale", FALSE)}: resizes the original image by aplying the given ratio to both sides
* {$img->method("resize", FALSE)}: resizes the original image file to match the given $size object
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Media/Img.php", false, true);

echo $parsedown->text(<<<MD
The $fig component implements the {$w3schools->getTagLink("figure")} tag. 
A $fig component consists of an $img component and an optional $figCaption component.

A $fig component specifies a self-contained content. While its content is related 
to the main flow, its position is independent of the main flow, and if removed 
it should not affect the flow of the document.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Html/Media/Figure.php", false, true);
