<?php

namespace Sphp\Html\Head;
use Sphp\Html\Programming\ScriptInterface as ScriptInterface;
$headNS = $api->getNamespaceLink(__NAMESPACE__);
$metaIfLnk = $api->getClassLink(HeadComponentInterface::class);
$head = $api->classLinker(Head::class);
$title = $api->classLinker(Title::class);
$meta = $api->classLinker(Meta::class);
$base = $api->classLinker(Base::class);
$link = $api->classLinker(Link::class);
$scriptInterface = $api->classLinker(ScriptInterface::class);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML HEAD Manipulation
        
$ns
        
This namespace contains an implementation of the HTML head. This element is a container for metadata (data about data)t.
The $head component implements the HTML head tag and acts as a 
container for all meta data components (data about data) $metaIfLnk.
This meta data is data about the HTML document and it is not directly displayed in any browsers.
		
The following PHP classes and interfaces describe HTML meta data components:

* $title - {$w3schools->getTagLink(Title::TAG_NAME)}
* $base - {$w3schools->getTagLink(Base::TAG_NAME)}
* $meta - {$w3schools->getTagLink(Meta::TAG_NAME)}
* $link - {$w3schools->getTagLink(Link::TAG_NAME)}
* $scriptInterface - {$w3schools->getTagLink(ScriptInterface::TAG_NAME)}

MD
);
//$in = new \Gajus\Dindent\Indenter();
//$html = $in->indent(FileUtils::executePhpToString(EXAMPLE_DIR . "html/head/head.php"));
/*$example1 = (new PHPExampleViewer())
		->fromFile(EXAMPLE_DIR . "html/head/head.php", true, "html5")
		->printHtml();
*/
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
//$s = new \Sphp\Html\Apps\SyntaxHighlighter();
//var_dump(FileUtils::executePhpToString(EXAMPLE_DIR . "html/head/head.php"));
//$s->setSource(FileUtils::executePhpToString(EXAMPLE_DIR . "html/head/head.php"), "html5")->printHtml();

//$load("Sphp.Html.Programming.php");
