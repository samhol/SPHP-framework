<?php

namespace Sphp\Html;

use Sphp\Manual;

$abstractTag = Manual\api()->classLinker(AbstractTag::class);
$ns = Manual\api()->namespaceLink(__NAMESPACE__);
$documentLink = Manual\api()->classLinker(Document::class);
$contentInterface = Manual\api()->classLinker(Content::class);
$exeption = Manual\php()->classLinker(\Exception::class);
$component = Manual\api()->classLinker(Component::class);
$emptyTag = Manual\api()->classLinker(EmptyTag::class);
$container = Manual\api()->classLinker(Container::class);
$containerComponent = Manual\api()->classLinker(ContainerComponent::class);
$contentTrait = Manual\api()->classLinker(ContentTrait::class);
$w3schools = Manual\w3schools();
$nsbc = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Introduction to HTML components{#html-intro}
$nsbc
        
The content of this namespace enables the creation of the HTML documents in object oriented PHP.
        
HTML is the standard markup language used to create Web pages. 
It is written in the form of HTML elements consisting of tags enclosed in angle brackets (like &lt;html&gt;).
HTML tags most commonly come in pairs like &lt;div&gt; and &lt;/div&gt;, although some tags represent
empty elements and so are unpaired, for example &lt;img&gt;. <cite>[[Wikipedia]]</cite> 
 
[Wikipedia]: http://en.wikipedia.org/wiki/HTML

SPHPlayground framework started first as an implementation of HTML tags in PHP language.
Therefore build in PHP interfaces and implementations describe HTML properties quite extensively and this framework uses actual HTML tag names as dedicated class with the tag name as class name.

**Links to HTML-resources:**

* <a href="http://www.w3.org/MarkUp/Guide/">W3C's Getting started with HTML</a>
* <a href="http://dev.w3.org/html5/spec/single-page.html">W3C's HTML 5 Specification</a>
* <a href="http://validator.w3.org/">W3C Markup Validation Service</a>

##The $contentInterface interface

All HTML components in $ns implement at least $contentInterface. This
interface ensures that the component can be outputted to an HTML document via the following three methods.


1. {$contentInterface->getHtml} returns the component as an HTML string. This method might throw an $exeption if the execution fails.
2. {$contentInterface->__toString} returns the component as an HTML string (PHP magic method)
3. {$contentInterface->printHtml} output the component as an HTML string or the exception description if the execution fails.


Trait $contentTrait gives an implementation to the subsequent
two of these methods leaving the implementation of the {$contentInterface->methodLink("getHtml")}
to the inheritor. Using this trait ensures that {$contentInterface->methodLink("__toString")}
will never throw any type of {$exeption} during execution.

##The $component interface and its $abstractTag implementation

The $component interface declares a group of methods for HTML attribute handling.
It is implemented in the abstract class $abstractTag.
$abstractTag is the first actual PHP implementation of a HTML tag in the framework.
It also defines the tagname property in {$abstractTag->methodLink("__construct")}.

##The $emptyTag class and empty `HTML` elements

The $emptyTag class is usable when generating empty HTML elements like:
{$w3schools->img}, {$w3schools->br}, {$w3schools->hr}, {$w3schools->input}, {$w3schools->wbr}, ...

##The $container and $containerComponent interfaces

The $container interface declares the properties
for an HTML container. Such container can store anything that can be output as a
PHP string.
MD
);

\Sphp\Manual\visualize('Sphp/Html/HtmlContainer.php');
$containerTag = Manual\api()->classLinker(ContainerTag::class);
Manual\md(<<<MD
The $containerComponent declares the properties fot a HTML wrapper element (a tag pair) acting as a
container for other elements. It has a implementation $containerTag in the framework.

Furthermore all actual framework components implement $component
}}

MD
);
Manual\md(<<<MD
##The $abstractTag class

This Abstract class is the base implementation  for all predefined HTML tag components.

**Note!** Use only HTML attributes that are specified for the underlying HTML tag name returned from the method getTagName().

MD
);
//PHPExampleViewer::visualize("Sphp/Html/ajax.php");
//PHPExampleViewer::visualize("Sphp/Html/AjaxLoaderInterface.php");
Manual\printPage('Sphp.Html.AjaxLoaderInterface.php');
//\Sphp\Manual\loadPage("Sphp.Html.Document.php");

Manual\md(<<<MD
https://caniuse.com/
MD
);
