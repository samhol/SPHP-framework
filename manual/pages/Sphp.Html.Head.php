<?php

namespace Sphp\Html\Head;

use Sphp\Html\Programming\ScriptInterface;

$headNS = $api->namespaceLink(__NAMESPACE__);
$metaIfLnk = $api->classLinker(HeadComponentInterface::class);
$head = $api->classLinker(Head::class);
$title = $api->classLinker(Title::class);
$meta = $api->classLinker(Meta::class);
$base = $api->classLinker(Base::class);
$link = $api->classLinker(Link::class);
$scriptInterface = $api->classLinker(ScriptInterface::class);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML HEAD: <small>metadata manipulation</small>
        
$ns
        
This namespace contains an implementation of the HTML head. This element is a container for metadata (data about data)t.
The $head component implements the HTML head tag and acts as a 
container for all meta data components (data about data) $metaIfLnk.
This meta data is data about the HTML document and it is not directly displayed in any browsers.
		
The following PHP classes and interfaces describe HTML meta data components:

* $title - {$w3schools->tag("title")}
* $base - {$w3schools->tag("base")}
* $meta - {$w3schools->tag("meta")}
* $link - {$w3schools->tag("link")}
* $scriptInterface - {$w3schools->tag("script")}

MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Head/Head1.php", "html5", false);
echo $parsedown->text(<<<MD
###The $head component and client side scripts
        
The best practice of placing client side scripts is the end of the page, just inside the closing body tag. 
This guarantees that all of the DOM elements needed are already present on the page. 
Loading scripts earlier could introduce timing issues and unnesessary usage of 
`window.onload` or some other method to determine when the DOM is ready to be used. 
By including scripts at the bottom of the page, it is assured that the DOM is ready 
to be poked and it is not reguired to delay initialization any further.
MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Head/Head2.php", "html5", false);
