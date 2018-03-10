<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Manual;

$flexInterface = Manual\api()->classLinker(ResponsiveEmbedInterface::class);
$flex = Manual\api()->classLinker(ResponsiveEmbed::class);

Manual\md(<<<MD
##Responsive multimedia content	
  
The $flex component is an implementation of $flexInterface for embedded media content.

This component implements Foundation Responsive Embed for PHP. $flex wraps embedded 
content like videos, maps, and calendars in a responsive embed container to maintain 
the correct aspect ratio regardless of screen size.
        
$flex lets browsers automatically scale most of the iframe based objects in webpages. 
It is possible to use $flex to create an intrinsic ratio that will properly 
scale the media on any device.
MD
);

Manual\visualize('Sphp/Html/Foundation/Sites/Media/ResponsiveEmbed.php');
