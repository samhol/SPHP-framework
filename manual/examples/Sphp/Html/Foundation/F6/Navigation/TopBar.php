<?php

namespace Sphp\Html\Foundation\F6\Navigation;

$navi = (new TopBar\TopBar("TopBar"));
$navi->left()->appendLink("http://www.ask.com/", "ask.com", "_blank");

$js = (new SubMenu("JavaScript"))
        ->appendText("jQuery related")
        ->appendLink("http://jquery.com/", "jQuery.com", "_blank")
        ->appendLink("http://ressio.github.io/lazy-load-xt/", "Lazy Load XT", "_blank")
        ->appendLink("https://modernizr.com/", "Modernizr", "_blank")
        ->appendLink("http://www.jslint.com/", "JSLint", "_blank")
        ->appendLink("http://gruntjs.com/", "GRUNT", "_blank");
$navi->right()->append($js);
$navi->printHtml();
?>