<?php

namespace Sphp\Html;

$abstractTag = $api->classLinker(AbstractTag::class);
$ns = $api->namespaceLink(__NAMESPACE__);
$documentLink = $api->classLinker(Document::class);
$contentInterface = $api->classLinker(ContentInterface::class);
$exeption = $php->classLinker(\Exception::class);
$componentInterface = $api->classLinker(ComponentInterface::class);
$emptyTag = $api->classLinker(EmptyTag::class);
$containerInterface = $api->classLinker(ContainerInterface::class);
$containerComponentInterface = $api->classLinker(ContainerComponentInterface::class);
$nsbc = $api->namespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
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


1. {$contentInterface->method("getHtml")} returns the component as an HTML string. This method might throw an $exeption) if the execution fails.
2. {$contentInterface->method("__toString")} returns the component as an HTML string (PHP magic method)
3. {$contentInterface->method("printHtml")} output the component as an HTML string or the exception description if the execution fails.


Trait {$api->classLinker(ContentTrait::class)} gives an implementation to the subsequent
two of these methods leaving the implementation of the {$contentInterface->method("getHtml")}
to the inheritor. Using this trait ensures that {$contentInterface->method("__toString")}
will never throw any type of {$exeption} during execution.

##The $componentInterface interface and its $abstractTag implementation

The $componentInterface interface declares a group of methods for HTML attribute handling.
It is implemented in the {$api->classLinker(IdentifiableComponentTrait::class)} trait and also in the abstract class $abstractTag.
$abstractTag is the first actual PHP implementation of a HTML tag in the framework.
It also defines the tagname property in {$abstractTag->method("__construct")}.

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

$exampleViewer(EXAMPLE_DIR . "Sphp/Html/HtmlContainer.php");

echo $parsedown->text(<<<MD
The $containerComponentInterface declares the properties fot a HTML wrapper element (a tag pair) acting as a
container for other elements. It has a implementation {$api->classLinker(ContainerTag::class)} in the framework.

Furthermore all actual framework components implement {$api->classLinker(ComponentInterface::class)}
}}

MD
);
echo $parsedown->text(<<<MD
##The {$api->classLinker(AbstractTag::class)} class

Abstract {$api->classLinker(AbstractTag::class)} class is the base implementation
of the {$api->classLinker(ComponentInterface::class)} for all predefined HTML tag components.
At least it is extended in every existing HTML component in the current framework.

**Note!** Use only HTML attributes that are specified for the underlying HTML tag name returned from the method getTagName().

MD
);
//PHPExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Html/ajax.php");
//PHPExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Html/AjaxLoaderInterface.php");
$load("Sphp.Html.AjaxLoaderInterface.php");
//$load("Sphp.Html.Document.php");
