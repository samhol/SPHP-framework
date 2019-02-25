<?php

namespace Sphp\Html\Head;

$head = (new Head("Foo Bar page", "utf-8"));
$head->set(Link::stylesheet("sph/css/ion.rangeSlider.css"));
$head->setBaseAddr('http://samiholck.com/', "_self");
$head->set(Meta::author('Sami Holck'));
$head->set(Meta::applicationName('FooBar'));
$head->set(Meta::keywords(['foo', 'bar', 'foobar']));
$head->printHtml();
