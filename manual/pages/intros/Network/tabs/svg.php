<?php

namespace Sphp\Html\Scripts;

use Sphp\Manual;

$scriptInterface = Manual\api()->classLinker(Script::class);
$scriptCode = Manual\api()->classLinker(ScriptCode::class);
$scriptFile = Manual\api()->classLinker(ScriptSrc::class);
$scriptsContainer = Manual\api()->classLinker(ScriptsContainer::class);
$noscript = Manual\api()->classLinker(Noscript::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$arrayAccess = Manual\php()->classLinker(\ArrayAccess::class);

Manual\md(<<<MD
## Scalable Vector Graphics (SVG) 

SVG is an XML-based vector image format for two-dimensional graphics. The 
specification is an open standard developed by the World Wide Web Consortium (W3C).

SVG images and their behaviors are defined in XML text files. SVG images can be 
searched, indexed, scripted, and compressed. All major modern web browsers have 
SVG rendering support.
        
**Links to SVG information and resouces:**

* <a href="https://en.wikipedia.org/wiki/Scalable_Vector_Graphics">Wikipedia, the free encyclopedia</a>
* <a href="https://www.w3.org/TR/2011/REC-SVG11-20110816/">Scalable Vector Graphics (SVG) 1.1 (Second Edition)</a>
* <a href="http://validator.w3.org/">W3C Markup Validation Service</a>
MD
);

$btnGroup = new \Sphp\Html\Foundation\Sites\Buttons\ButtonGroup();
$btnGroup->appendHyperlink('/Sphp.Html.Media.Icons#SVG', 'SVG objects')->addCssClass('svg');
$btnGroup->appendHyperlink('/Sphp.Html.Media.Icons#SVG', 'SVG resource loader')->addCssClass('svg');
echo $btnGroup;
