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
$metaTag = Manual\api()->classLinker(MetaTag::class);
$meta = Manual\api()->classLinker(Meta::class);
$base = Manual\api()->classLinker(Base::class);
$link = Manual\api()->classLinker(LinkTag::class);
$script = Manual\api()->classLinker(Script::class);
$noscript = Manual\api()->classLinker(Noscript::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
Manual\md(<<<MD
# JavaScripts and Meta Data
    
This section decribes implementations of Client Side Scripting and HTML head elements. 

MD
);
Manual\md(<<<MD
        
## HTML head

$ns

The $head component implements the HTML head tag and is a container for all meta 
data components (data about data) $headContent. The following list of PHP classes describe HTML meta data components:

* $title -  implements HTML {$w3schools->title} tag. 
* $base -  implements HTML {$w3schools->base} tag. 
* $metaTag -  implements HTML {$w3schools->meta} tag. 
  * information about the HTML document
  * $meta is an object factory for $metaInterface objects defining different meta data properties.
* $link -  implements HTML {$w3schools->tag("link")} tag. 
  * A link defines the relationship between a document and an external resource. It is most used to link to stylesheets.
* $script - {$w3schools->script}
* $noscript - {$w3schools->noscript}

MD
);

Manual\visualize('Sphp/Html/Head/Head1.php', 'html5', false);


//Manual\visualize('Sphp/Html/Head/MetaInterface.php', 'html5', false);

$code1 = Manual\codeModal('YAML file', 'Sphp/Html/Head/meta.yaml', 'YAML Meta data example');
$tr1 = $code1->getTrigger()->addCssClass('button', 'alert', 'radius', 'small', 'hide-from-pdf');
$code1->getPopup()->addCssClass('hide-from-pdf');
echo $code1;
$phpArr = \Sphp\Stdlib\Filesystem::executePhpToString('Sphp/Html/Head/meta-array.php');
$code2 = Manual\codeModalFromString('PHP array', $phpArr, 'php', 'PHP Meta data example');
$tr2 = $code2->getTrigger()->addCssClass('button', 'secondary', 'radius', 'small', 'hide-from-pdf');

echo $code2;

Manual\visualize('Sphp/Html/Head/MetaGroup.php', 'html5', false);

Manual\printPage('Sphp.Html.Scripts');
Manual\md(<<<MD
###References:

* [A list of everything that *could* go in the `head` of your document](https://github.com/joshbuchea/HEAD){target=_blank}

MD
);
