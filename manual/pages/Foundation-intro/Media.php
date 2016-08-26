<?php

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\Apps\Manual\Apis as Apis;
use Sphp\Core\Util\FileUtils as FileUtils;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$flexVideo = Apis::apigen()->classLinker(Flex::class);
$mediaExample = FileUtils::executePhpToString(EXAMPLE_DIR . 'Sphp/Html/Foundation/F6/Media/Flex.php');
$manLink = new \Sphp\Html\Foundation\F6\Buttons\HyperlinkButton("?page=Sphp.Html.Foundation.F6.Media", "Manual page", "_self");
echo <<<MD
##Foundation 6 Media components:

$ns
        
$manLink
        
This namespace contains components for handling different media types
using the tools provided by Foundation framework.

###$flexVideo example:
        
$mediaExample
MD
;
