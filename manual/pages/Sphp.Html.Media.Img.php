<?php

namespace Sphp\Html\Media;

$imgInterface = \Sphp\Manual\api()->classLinker(ImgInterface::class);
$img = \Sphp\Manual\api()->classLinker(Img::class);
$fig = \Sphp\Manual\api()->classLinker(Figure::class);
$figCaption = \Sphp\Manual\api()->classLinker(FigCaption::class);
\Sphp\Manual\md(<<<MD
##The $img and the $fig components

An $img component implements the $imgInterface. 
$img provides static factory methods for showing resized image components. 
		
**List of factory methods creating new resized instances of the $img:**

* {$img->methodLink("scaleToFit")}: scales the original image file to fit the given box while constraining proportions
* {$img->methodLink("widen")}: resizes the original image to given width, constraining proportions
* {$img->methodLink("heighten")}: resizes the original image to given height, constraining proportions
* {$img->methodLink("scale")}: resizes the original image by aplying the given ratio to both sides
* {$img->methodLink("resize")}: resizes the original image file to match the given dimensions
MD
);

\Sphp\Manual\visualize('Sphp/Html/Media/Img.php', null, true);
$figureTag = \Sphp\Manual\w3schools()->tag('figure');
\Sphp\Manual\md(<<<MD
The $fig component implements the $figureTag tag. 
A $fig component consists of an $img component and an optional $figCaption component.

A $fig component specifies a self-contained content. While its content is related 
to the main flow, its position is independent of the main flow, and if removed 
it should not affect the flow of the document.
MD
);

\Sphp\Manual\visualize('Sphp/Html/Media/Figure.php', null, true);

