<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$flexInterface = $api->classLinker(FlexInterface::class);
$flex = $api->classLinker(Flex::class);

echo $parsedown->text(<<<MD
		
##The $flex component implementing $flexInterface for embedded media content

$flexInterface simply defines the Foundation Flex Video element for the framework.
        
$flex lets browsers automatically scale most of the iframe based objects in webpages. 
It is possible to use $flex to create an intrinsic ratio that will properly 
scale the media on any device.
MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/Flex-LazyLoad.php');