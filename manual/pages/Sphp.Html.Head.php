<?php

namespace Sphp\Html\Head;

use Sphp\Html\Programming\ScriptInterface;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
$headNS = Apis::sami()->namespaceLink(__NAMESPACE__);
$metaIfLnk = Apis::sami()->classLinker(HeadComponentInterface::class);
$head = Apis::sami()->classLinker(Head::class);
$title = Apis::sami()->classLinker(Title::class);
$metaInterface = Apis::sami()->classLinker(MetaInterface::class);
$metaContainer = Apis::sami()->classLinker(MetaContainer::class);
$meta = Apis::sami()->classLinker(Meta::class);
$base = Apis::sami()->classLinker(Base::class);
$link = Apis::sami()->classLinker(Link::class);
$scriptInterface = Apis::sami()->classLinker(ScriptInterface::class);
$w3schools = Apis::w3schools();
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML HEAD: <small>meta data manipulation</small>
        
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

CodeExampleBuilder::visualize("Sphp/Html/Head/Head1.php", "html5", false);
echo $parsedown->text(<<<MD
##META DATA OBJECTS: <small>$meta object implementing $metaInterface</small>{#MetaInterface}

$meta class works also as a object factory for $metaInterface objects implementing different meta data properties.
All $metaInterface types can be stored into a $metaContainer container.
MD
);
CodeExampleBuilder::visualize("Sphp/Html/Head/MetaInterface.php", "html5", false);
echo $parsedown->text(<<<MD
##The $head component and client side scripts
        
The best practice of placing client side scripts is the end of the page, just inside the closing body tag. 
This guarantees that all of the DOM elements needed are already present on the page. 
Loading scripts earlier could introduce timing issues and unnesessary usage of 
`window.onload` or some other method to determine when the DOM is ready to be used. 
By including scripts at the bottom of the page, it is assured that the DOM is ready 
to be poked and it is not reguired to delay initialization any further.
MD
);
CodeExampleBuilder::visualize("Sphp/Html/Head/Head2.php", "html5", false);
