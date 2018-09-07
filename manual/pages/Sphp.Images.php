<?php

namespace Sphp\Images;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$scaler = \Sphp\Manual\api()->classLinker(Image::class);
$abstractScaler = \Sphp\Manual\api()->classLinker(AbstractImage::class);
$imagineScaler = \Sphp\Manual\api()->classLinker(ImagineImage::class);

\Sphp\Manual\md(<<<MD
#IMAGE MANIPULATION
$ns        
##The $scaler interface
	
**List of $scaler methods creating new resized images from an original:**

* {$scaler->scaleToFit}: scales the original image file to fit the given box while constraining proportions
* {$scaler->widen}: resizes the original image to given width, constraining proportions
* {$scaler->heighten}: resizes the original image to given height, constraining proportions
* {$scaler->scale}: resizes the original image by aplying the given ratio to both sides
* {$scaler->resize}: resizes the original image file to match the given dimensions
MD
);
//echo \Sphp\Manual\syntaxView('manual/pics/example.jpg.php');

namespace Sphp\Html\Media;

$imgInterface = \Sphp\Manual\api()->classLinker(ImgInterface::class);
$img = \Sphp\Manual\api()->classLinker(Img::class);
$fig = \Sphp\Manual\api()->classLinker(Figure::class);
$figCaption = \Sphp\Manual\api()->classLinker(FigCaption::class);
$w3c = \Sphp\Manual\w3schools();

\Sphp\Manual\md(<<<MD
###Using $scaler with $img components
 
$img component implements HTML {$w3c->img} tag 	via $imgInterface interface. 
MD
);
\Sphp\Manual\visualize('Sphp/Images/Image-Cache.php', 'html5');
