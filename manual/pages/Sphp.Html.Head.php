<?php

namespace Sphp\Html\Head;

use Sphp\Html\Scripts\Script;
use Sphp\Html\Scripts\Noscript;
use Sphp\Manual;

$sami = Manual\api();
$headNS = $sami->namespaceLink(__NAMESPACE__);
$headContent = Manual\api()->classLinker(HeadContent::class);
$head = Manual\api()->classLinker(Head::class);
$title = Manual\api()->classLinker(Title::class);
$metaInterface = Manual\api()->classLinker(MetaData::class);
$meta = Manual\api()->classLinker(MetaTag::class);
$base = Manual\api()->classLinker(Base::class);
$link = Manual\api()->classLinker(LinkTag::class);
$script = Manual\api()->classLinker(Script::class);
$noscript = Manual\api()->classLinker(Noscript::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\md(<<<MD
#HTML head: <small>meta data manipulation</small>
        
$ns
        
This namespace contains an implementations for HTML head elements. 
This meta data is data about the HTML document and it is not directly displayed in any browsers.

The $head component implements the HTML head tag and is a container for all meta 
data components (data about data) $headContent. The following list of PHP classes describe HTML meta data components:

* $title - {$w3schools->title}
* $base - {$w3schools->base}
* $meta - {$w3schools->meta}
* $link - {$w3schools->link}
* $script - {$w3schools->script}
* $noscript - {$w3schools->noscript}

MD
);

Manual\visualize('Sphp/Html/Head/Head1.php', 'html5', false);

Manual\printPage('Sphp.Html.Head.Link');
Manual\printPage('Sphp.Html.Head.MetaData');
Manual\printPage('Sphp.Html.Head.Scripts');

Manual\md(<<<MD
###References:

* [A list of everything that *could* go in the `head` of your document](https://github.com/joshbuchea/HEAD){target=_blank}

MD
);
