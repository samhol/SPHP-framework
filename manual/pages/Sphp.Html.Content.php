<?php

namespace Sphp\Html\Content;

use Sphp\Manual;

$main = Manual\api()->classLinker(Main::class);
$section = Manual\api()->classLinker(Section::class);
$aside = Manual\api()->classLinker(Aside::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\parseDown(<<<MD
#HTML CONTENT CREATION
$ns

The content of this namespace enables the creation of the HTML documents in object oriented PHP.

##The $main container
        
This component specifies the main content of a HTML document. It implements $w3schools->main
        
The $w3schools->aside tag defines some content aside from the content it is placed in.

The aside content should be related to the surrounding content.
MD
);

Manual\visualize('Sphp/Html/Content/Main.php', 'html5');
