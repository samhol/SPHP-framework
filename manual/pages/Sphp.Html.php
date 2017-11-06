<?php

namespace Sphp\Html;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$abstractTag = \Sphp\Manual\api()->classLinker(AbstractTag::class);
$ns = \Sphp\Manual\api()->namespaceLink(__NAMESPACE__);
$documentLink = \Sphp\Manual\api()->classLinker(Document::class);
$contentInterface = \Sphp\Manual\api()->classLinker(ContentInterface::class);
$exeption = Apis::phpManual()->classLinker(\Exception::class);
$componentInterface = \Sphp\Manual\api()->classLinker(ComponentInterface::class);
$emptyTag = \Sphp\Manual\api()->classLinker(EmptyTag::class);
$containerInterface = \Sphp\Manual\api()->classLinker(ContainerInterface::class);
$containerComponentInterface = \Sphp\Manual\api()->classLinker(ContainerComponentInterface::class);
$contentTrait = \Sphp\Manual\api()->classLinker(ContentTrait::class);
$w3schools = Apis::w3schools();
$nsbc = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#Introduction to HTML components
$nsbc
HTML is the standard markup language used to create Web pages.

>HTML is written in the form of HTML elements consisting of tags enclosed in angle brackets (like &lt;html&gt;).
HTML tags most commonly come in pairs like &lt;h1&gt; and &lt;/h1&gt;, although some tags represent
empty elements and so are unpaired, for example &lt;img&gt;. The first tag in a pair is the start tag, and the second
tag is the end tag (they are also called opening tags and closing tags).<cite>[[Wikipedia]]</cite>

[Wikipedia]: http://en.wikipedia.org/wiki/HTML

The content of the $ns namespace enables the creation of the HTML documents in object oriented PHP.

This PHP framework started first as an implementation of the basic html structure in PHP language.
Therefore the basic interfaces and their build in implementations describe these HTML properties quite extensively.

**Links to HTML-resources:**

* <a href="http://www.w3.org/MarkUp/Guide/">W3C's Getting started with HTML</a>
* <a href="http://dev.w3.org/html5/spec/single-page.html">W3C's HTML 5 Specification</a>
* <a href="http://validator.w3.org/">W3C Markup Validation Service</a>

##The $contentInterface interface

All HTML components in $ns implement at least $contentInterface. This
interface ensures that the component can be outputted to an HTML document via the following three methods.


1. {$contentInterface->methodLink("getHtml")} returns the component as an HTML string. This method might throw an $exeption) if the execution fails.
2. {$contentInterface->methodLink("__toString")} returns the component as an HTML string (PHP magic method)
3. {$contentInterface->methodLink("printHtml")} output the component as an HTML string or the exception description if the execution fails.


Trait $contentTrait gives an implementation to the subsequent
two of these methods leaving the implementation of the {$contentInterface->methodLink("getHtml")}
to the inheritor. Using this trait ensures that {$contentInterface->methodLink("__toString")}
will never throw any type of {$exeption} during execution.

##The $componentInterface interface and its $abstractTag implementation

The $componentInterface interface declares a group of methods for HTML attribute handling.
It is implemented in the abstract class $abstractTag.
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
PHP string.
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
##The $abstractTag class

This Abstract class is the base implementation  for all predefined HTML tag components.

**Note!** Use only HTML attributes that are specified for the underlying HTML tag name returned from the method getTagName().

MD
);
//PHPExampleViewer::visualize("Sphp/Html/ajax.php");
//PHPExampleViewer::visualize("Sphp/Html/AjaxLoaderInterface.php");
\Sphp\Manual\loadPage("Sphp.Html.AjaxLoaderInterface.php");
//\Sphp\Manual\loadPage("Sphp.Html.Document.php");
