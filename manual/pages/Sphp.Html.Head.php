<?php

namespace Sphp\Html\Head;

use Sphp\Html\Programming\Script;
use Sphp\Html\Programming\Noscript;
use Sphp\Manual;

$headNS = Manual\api()->namespaceLink(__NAMESPACE__);
$headContent = Manual\api()->classLinker(HeadContent::class);
$head = Manual\api()->classLinker(Head::class);
$title = Manual\api()->classLinker(Title::class);
$metaInterface = Manual\api()->classLinker(MetaData::class);
$metaContainer = Manual\api()->classLinker(MetaContainer::class);
$meta = Manual\api()->classLinker(Meta::class);
$base = Manual\api()->classLinker(Base::class);
$link = Manual\api()->classLinker(Link::class);
$script = Manual\api()->classLinker(Script::class);
$noscript = Manual\api()->classLinker(Noscript::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\parseDown(<<<MD
#HTML HEAD: <small>meta data manipulation</small>
        
$ns
        
This namespace contains an implementations for HTML head elements. 
This meta data is data about the HTML document and it is not directly displayed in any browsers.

The $head component implements the HTML head tag and acts as a 
container for all meta data components (data about data) $headContent.
		
The following PHP classes and interfaces implement $headContent and thus describe HTML meta data components:

* $title - {$w3schools->tag("title")}
* $base - {$w3schools->tag("base")}
* $meta - {$w3schools->tag("meta")}
* $link - {$w3schools->tag("link")}
* $script - {$w3schools->tag("script")}
* $noscript - {$w3schools->tag("noscript")}

MD
);

Manual\visualize('Sphp/Html/Head/Head1.php', 'html5', false);

Manual\loadPage('Sphp.Html.Head.Link');
Manual\loadPage('Sphp.Html.Head.MetaData');
Manual\loadPage('Sphp.Html.Head.Scripts');

Manual\parseDown(<<<MD
###References:

* [A list of everything that *could* go in the `head` of your document](https://github.com/joshbuchea/HEAD){target=_blank}

MD
);
