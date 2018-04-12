<?php

namespace Sphp\Html\Head;

$head = (new Head("Foo Bar page", "utf-8"));
$head->setBaseAddr("http://foo.bar/", "_self");
$head->setCssSrc("sph/css/ion.rangeSlider.css");
$head->appendScriptSrc("http://code.jquery.com/jquery-2.1.3.min.js");
$head->setBaseAddr("http://samiholck.com/", "_self");
$head->set(Meta::author('Sami Holck'));
$head->set(Meta::httpEquiv("Content-Type", "text/html; charset=utf-8"));
$head->set(Meta::applicationName('Foo app'));
$head->set(Meta::keywords(['php', 'scss', 'css', 'html', 'js']));
$head->printHtml();
