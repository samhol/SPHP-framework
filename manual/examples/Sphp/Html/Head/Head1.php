<?php

namespace Sphp\Html\Head;

$head = (new Head("Foo Bar page", "utf-8"));
$head->setBaseAddr("http://foo.bar/", "_self")
        ->addCssSrc("sph/css/ion.rangeSlider.css")
        ->appendScriptSrc("http://code.jquery.com/jquery-2.1.3.min.js")
        ->setBaseAddr("http://samiholck.com/", "_self")
        ->add(Meta::author('Sami Holck'))
        ->add(Meta::httpEquiv("Content-Type", "text/html; charset=utf-8"))
        ->add(Meta::applicationName('SPHP framework'))
        ->add(Meta::keywords(
                        ['php', 'scss', 'css', 'html', 'html5', 'javascript', 'jquery']))
        ->printHtml();
