<?php

namespace Sphp\Html\Head;

$head = (new Head("Foo Bar page", "utf-8"));
$head->setBaseAddr("http://foo.bar/", "_self")
        ->addCssSrc("sph/css/ion.rangeSlider.css")
        ->appendScriptSrc("http://code.jquery.com/jquery-2.1.3.min.js")
        ->setBaseAddr("http://samiholck.com/", "_self");
$head->metaTags()
        ->setApplicationName("Foo Bar")
        ->setAuthor("Sami Holck")
        ->setKeywords("foo bar foobar")
        ->setDescription("What ever");
$head->printHtml();
?>
