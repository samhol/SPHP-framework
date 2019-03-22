<?php

namespace Sphp\Html\Media;

$imgInterface = \Sphp\Manual\api()->classLinker(ImgInterface::class);
$img = \Sphp\Manual\api()->classLinker(Img::class);
$fig = \Sphp\Manual\api()->classLinker(Figure::class);
$figCaption = \Sphp\Manual\api()->classLinker(FigCaption::class);
$w3c = \Sphp\Manual\w3schools();
\Sphp\Manual\md(<<<MD
##The $img and the $fig components
 
$img component implements HTML {$w3c->img} tag 	via $imgInterface interface. 

MD
);
//echo \Sphp\Manual\syntaxView('manual/pics/example.jpg.php');
\Sphp\Manual\visualize('Sphp/Images/Image-Cache.php', 'html5');
\Sphp\Manual\visualize('Sphp/Html/Media/Img.php', null, true);
$figureTag = \Sphp\Manual\w3schools()->figure;
\Sphp\Manual\md(<<<MD
The $fig component implements the $figureTag tag. 
A $fig component consists of an $img component and an optional $figCaption component.

A $fig component specifies a self-contained content. While its content is related 
to the main flow, its position is independent of the main flow, and if removed 
it should not affect the flow of the document.
MD
);

\Sphp\Manual\visualize('Sphp/Html/Media/Figure.php', null, true);
