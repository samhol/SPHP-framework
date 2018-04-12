<?php

namespace Sphp\Html\Head;

use Sphp\Html\Programming\Script;
use Sphp\Manual;

$headNS = Manual\api()->namespaceLink(__NAMESPACE__);
$metaIfLnk = Manual\api()->classLinker(HeadContent::class);
$head = Manual\api()->classLinker(Head::class);
$title = Manual\api()->classLinker(Title::class);
$metaInterface = Manual\api()->classLinker(MetaData::class);
$meta = Manual\api()->classLinker(MetaTag::class);
$base = Manual\api()->classLinker(Base::class);
$link = Manual\api()->classLinker(LinkTag::class);
$scriptInterface = Manual\api()->classLinker(Script::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);


Manual\md(<<<MD
##The $head component and client side scripts
        
The best practice of placing client side scripts is the end of the page, just inside the closing body tag. 
This guarantees that all of the DOM elements needed are already present on the page. 
Loading scripts earlier could introduce timing issues and unnesessary usage of 
`window.onload` or some other method to determine when the DOM is ready to be used. 
By including scripts at the bottom of the page, it is assured that the DOM is ready 
to be poked and it is not reguired to delay initialization any further.
MD
);
Manual\visualize('Sphp/Html/Head/Head2.php', 'html5', false);

