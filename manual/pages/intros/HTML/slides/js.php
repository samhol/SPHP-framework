<?php

namespace Sphp\Html;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
echo <<<MD
## JavaScripts in SPHPlayground

JavaScript is a high-level, interpreted programming language. It is characterized 
as dynamic, weakly typed, prototype-based and multi-paradigm language. It is one 
of the core technologies of the World Wide Web. JavaScript is an essential 
part of modern web applications and all major web browsers can execute it.

**Links to JavaScript resources:**

* <a href="http://www.w3.org/MarkUp/Guide/">W3C's Getting started with HTML</a>
* <a href="http://dev.w3.org/html5/spec/single-page.html">W3C's HTML 5 Specification</a>
* <a href="http://validator.w3.org/">W3C Markup Validation Service</a>

Client side JavaScript can be inserted and manipulated using SPHPlayground PHP 
classes. However the general idea is to minimize the need to write clientside JavaScript.
 
MD
;

$btnGroup = new Foundation\Sites\Buttons\ButtonGroup();
$btnGroup->appendHyperlink('/Sphp.Html.JS-META#js-h1', '<i class="fab fa-js-square"></i> JavaScript containers')->addCssClass('js');
echo $btnGroup;
