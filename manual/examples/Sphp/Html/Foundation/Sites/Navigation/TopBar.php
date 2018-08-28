<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$navi = (new TopBar("TopBar"));
$navi->left()->appendLink("http://www.ask.com/", "ask.com", "_blank");

$js = (new SubMenu("JavaScript"));
$js->appendText("jQuery related");
$js->appendLink("http://jquery.com/", "jQuery.com");
$js->appendLink("http://ressio.github.io/lazy-load-xt/", "Lazy Load XT");
$js->appendLink("https://modernizr.com/", "Modernizr");
$js->appendLink("http://www.jslint.com/", "JSLint");
$js->appendLink("http://gruntjs.com/", "GRUNT");

$navi->right()->append($js);
$navi->printHtml();
