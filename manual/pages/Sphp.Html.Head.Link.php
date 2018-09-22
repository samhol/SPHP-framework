<?php

namespace Sphp\Html\Head;

use Sphp\Html\Scripts\Script;
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
##$link: <small>a link between a document and an external resource</small>
    
$link component implements {$w3schools->tag("link")} tag.

A &lt;link&gt; defines the relationship between a document and an
external resource. The &lt;link&gt; tag is most used to link to style
sheets. 
        
MD
);

Manual\visualize('Sphp/Html/Head/Head1.php', 'html5', false);

