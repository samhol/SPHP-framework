<?php

namespace Sphp\Html\Head;

use Sphp\Html\Programming\ScriptInterface;
use Sphp\Manual;

$headNS = Manual\api()->namespaceLink(__NAMESPACE__);
$metaIfLnk = Manual\api()->classLinker(HeadContent::class);
$head = Manual\api()->classLinker(Head::class);
$title = Manual\api()->classLinker(Title::class);
$metaInterface = Manual\api()->classLinker(MetaData::class);
$metaContainer = Manual\api()->classLinker(MetaContainer::class);
$meta = Manual\api()->classLinker(Meta::class);
$base = Manual\api()->classLinker(Base::class);
$link = Manual\api()->classLinker(Link::class);
$scriptInterface = Manual\api()->classLinker(ScriptInterface::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\parseDown(<<<MD
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

Manual\visualize('Sphp/Html/Head/Head1.php', 'html5', false);
Manual\parseDown(<<<MD
##META DATA OBJECTS: <small>$meta object implementing $metaInterface</small>{#MetaInterface}

$meta class works also as a object factory for $metaInterface objects implementing different meta data properties.
All $metaInterface types can be stored into a $metaContainer container.
MD
);
Manual\visualize('Sphp/Html/Head/MetaInterface.php', 'html5', false);
Manual\parseDown(<<<MD
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

Manual\parseDown(<<<MD
##External resources

* A list of everything that *could* go in the <head> of your document https://github.com/joshbuchea/HEAD
  
  
MD
);
