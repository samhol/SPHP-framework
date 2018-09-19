<?php

namespace Sphp\Html\Head;

$head = (new Head("Document title", "utf-8"));
$head->setBaseAddr("http://sphp.samiholck.com/", "_self");
$head->setShortcutIcon("sph/favicon.ico")
        ->set(Meta::author('Sami Holck'))
        ->set(Meta::applicationName('SPHP framework'))
        ->set(Meta::keywords(
                        ['php', 'scss', 'css', 'html', 'html5', 'javascript', 'jquery']))
        ->set(Meta::description('SPHP framework for web developement'));
$head->printHtml();
