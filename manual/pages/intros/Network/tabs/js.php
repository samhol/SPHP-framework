<?php

namespace Sphp\Html;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
echo <<<MD
## JavaScripts language

JavaScript is a high-level, interpreted programming language. It is characterized 
as dynamic, weakly typed, prototype-based and multi-paradigm language. It is one 
of the core technologies of the World Wide Web. JavaScript is an essential 
part of modern web applications and all major web browsers can execute it.

**Links to JavaScript resources:**

* <a href="https://en.wikipedia.org/wiki/JavaScript">Wikipedia, the free encyclopedia</a>
* <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript">MDN: JavaScripts</a>

### JavaScripts in this framework

Client side JavaScript can be inserted and manipulated using SPHPlayground PHP 
classes. However the general idea is to minimize the need to write clientside JavaScript.
 
MD
;

$btnGroup = new Foundation\Sites\Buttons\ButtonGroup();
$btnGroup->appendHyperlink('/Sphp.Html.JS-META#js-h1', '<i class="fab fa-js-square"></i> JavaScript containers')->addCssClass('js');
echo $btnGroup;
