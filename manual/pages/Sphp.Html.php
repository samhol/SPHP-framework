<?php

namespace Sphp\Html;

use Sphp\Manual;

$abstractTag = Manual\api()->classLinker(AbstractTag::class);
$ns = Manual\api()->namespaceLink(__NAMESPACE__);
$documentLink = Manual\api()->classLinker(SphpDocument::class);
$contentInterface = Manual\api()->classLinker(Content::class);
$exeption = Manual\php()->classLinker(\Exception::class);
$component = Manual\api()->classLinker(Component::class);
$emptyTag = Manual\api()->classLinker(EmptyTag::class);
$container = Manual\api()->classLinker(Container::class);
$containerComponent = Manual\api()->classLinker(ContainerComponent::class);
$abstractContent = Manual\api()->classLinker(AbstractContent::class);
$w3schools = Manual\w3schools();
$nsbc = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);


Manual\md(<<<MD
#Introduction to HTML components{#html-intro}

$nsbc
  
The HTML namespace contains mobile friendly customizable UI 
components compatibile with most web browsers and devices. Most UI components are 
based on Foundation frontend framework.        
  
MD
);
include 'manual/pages/intros/HTML/orbit.php';
Manual\md(<<<MD
              

##The $contentInterface interface

All HTML components in $ns implement at least $contentInterface. This
interface ensures that the component can be outputted to an HTML document via the following three methods.


1. {$contentInterface->getHtml} returns the component as an HTML string. This method might throw an $exeption if the execution fails.
2. {$contentInterface->__toString} returns the component as an HTML string (PHP magic method)
3. {$contentInterface->printHtml} output the component as an HTML string or the exception description if the execution fails.


$abstractContent gives an implementation to the subsequent
two of these methods leaving the implementation of the {$contentInterface->methodLink("getHtml")}
to the inheritor. Using this trait ensures that {$contentInterface->methodLink("__toString")}
will never throw any type of {$exeption} during execution.

##The $component interface and its $abstractTag implementation

The $component interface declares a group of methods for HTML attribute handling.
It is implemented in the abstract class $abstractTag.
$abstractTag is the first actual PHP implementation of a HTML tag in the framework.
It also defines the tagname property in {$abstractTag->methodLink("__construct")}.

 * $emptyTag class implements empty `HTML` elements
   * It is usefull when generating empty HTML elements like: {$w3schools->img}, {$w3schools->br}, {$w3schools->hr}, {$w3schools->input}, {$w3schools->wbr}, ...
 * $container and $containerComponent interfaces
   * $container interface declares the properties for an HTML container. Such container can store anything that can be output as a PHP string.
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
