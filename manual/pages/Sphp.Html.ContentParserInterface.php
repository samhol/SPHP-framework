<?php

namespace Sphp\Html;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$contentParserInterface = \Sphp\Manual\api()->classLinker(ContentParser::class);
$contentParsingTrait = \Sphp\Manual\api()->classLinker(ContentParsingTrait::class);
$ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__);
$documentLink = \Sphp\Manual\api()->classLinker(Document::class);
$contentInterface = \Sphp\Manual\api()->classLinker(Content::class);
$exeption = Apis::phpManual()->classLinker(\Exception::class);
$componentInterface = \Sphp\Manual\api()->classLinker(ComponentInterface::class);
$emptyTag = \Sphp\Manual\api()->classLinker(EmptyTag::class);
$containerInterface = \Sphp\Manual\api()->classLinker(ContainerInterface::class);
$containerComponentInterface = \Sphp\Manual\api()->classLinker(ContainerComponentInterface::class);
$contentTrait = \Sphp\Manual\api()->classLinker(ContentTrait::class);
$nsbc = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
##Server side content parsing: <small>$contentParserInterface implementations</small>

1. {$contentInterface->methodLink("getHtml")} returns the component as an HTML string. This method might throw an $exeption) if the execution fails.
2. {$contentInterface->methodLink("__toString")} returns the component as an HTML string (PHP magic method)
3. {$contentInterface->methodLink("printHtml")} output the component as an HTML string or the exception description if the execution fails.


Trait $contentParsingTrait gives an implementation to $contentParserInterface. This trait can be
two of these methods leaving the implementation of the {$contentInterface->methodLink("getHtml")}
to the inheritor. Using this trait ensures that {$contentInterface->methodLink("__toString")}
will never throw any type of {$exeption} during execution.

##The $componentInterface interface and its $abstractTag implementation

The $componentInterface interface declares a group of methods for HTML attribute handling.
It is implemented in the {$api->classLinker(IdentifiableComponentTrait::class)} trait and also in the abstract class $abstractTag.
$abstractTag is the first actual PHP implementation of a HTML tag in the framework.
It also defines the tagname property in {$abstractTag->methodLink("__construct")}.

##The $emptyTag class and empty `HTML` elements

The $emptyTag class is usable when generating empty HTML elements like:
{$w3schools->tag("img")},
{$w3schools->tag("br")},
{$w3schools->tag("hr")},
{$w3schools->tag("input")},
{$w3schools->tag("wbr")}, ...

##The $containerInterface and $containerComponentInterface interfaces

The $containerInterface declares the properties
for an HTML container. Such container can store anything that can be output as a
PHP string. The simplest build in implementor for the $containerInterface is the
{$api->classLinker(Container::class)} class.
MD
);

CodeExampleBuilder::visualize("Sphp/Html/HtmlContainer.php");
$containerTag = \Sphp\Manual\api()->classLinker(ContainerTag::class);
\Sphp\Manual\parseDown(<<<MD
The $containerComponentInterface declares the properties fot a HTML wrapper element (a tag pair) acting as a
container for other elements. It has a implementation $containerTag in the framework.

Furthermore all actual framework components implement $componentInterface
}}

MD
);
\Sphp\Manual\parseDown(<<<MD
##The {$api->classLinker(AbstractTag::class)} class

Abstract {$api->classLinker(AbstractTag::class)} class is the base implementation
of the {$api->classLinker(ComponentInterface::class)} for all predefined HTML tag components.
At least it is extended in every existing HTML component in the current framework.

**Note!** Use only HTML attributes that are specified for the underlying HTML tag name returned from the method getTagName().

MD
);
//PHPExampleViewer::visualize("Sphp/Html/ajax.php");
//PHPExampleViewer::visualize("Sphp/Html/AjaxLoaderInterface.php");
\Sphp\Manual\loadPage("Sphp.Html.AjaxLoaderInterface.php");
//\Sphp\Manual\loadPage("Sphp.Html.Document.php");
