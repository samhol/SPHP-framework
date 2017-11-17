<?php

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Manual;

$flexInterface = Manual\api()->classLinker(ResponsiveEmbedInterface::class);
$flex = Manual\api()->classLinker(ResponsiveEmbed::class);

Manual\parseDown(<<<MD
		
##The $flex component implementing $flexInterface for embedded media content

$flexInterface simply defines the Foundation Flex Video element for the framework.
        
$flex lets browsers automatically scale most of the iframe based objects in webpages. 
It is possible to use $flex to create an intrinsic ratio that will properly 
scale the media on any device.
MD
);

Manual\visualize('Sphp/Html/Foundation/Sites/Media/ResponsiveEmbed.php');
