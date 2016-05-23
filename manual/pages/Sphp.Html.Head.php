<?php

namespace Sphp\Html\Head;

$headNS = $api->getNamespaceLink(__NAMESPACE__);
$metaIfLnk = $api->getClassLink(MetaDataInterface::class);
$head = $api->getClassLink(Head::class);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#HTML HEAD ELEMENTS


$ns
        
This namespace contains an implementation of the HTML head. This element is a container for metadata (data about data)t.
The $head component implements the HTML head tag and acts as a 
container for all meta data components (data about data) $metaIfLnk.
This meta data is data about the HTML document and it is not directly displayed in any browsers.
		
The following classes in the $headNS package describe meta data:

* {$api->getClassLink(Title::class)}
* {$api->getClassLink(Base::class)}
* {$api->getClassLink(Meta::class)}
* {$api->getClassLink(Link::class)}
* {$api->getClassLink(\Sphp\Html\Programming\ScriptInterface::class)}

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
The $head component has build in methods for 
MD
); 
$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Head/Head2.php", "html5", false);
//$s = new \Sphp\Html\Apps\SyntaxHighlighter();
//var_dump(FileUtils::executePhpToString(EXAMPLE_DIR . "html/head/head.php"));
//$s->setSource(FileUtils::executePhpToString(EXAMPLE_DIR . "html/head/head.php"), "html5")->printHtml();

$load("Sphp.Html.Programming.php");
