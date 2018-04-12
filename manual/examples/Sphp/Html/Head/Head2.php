<?php

namespace Sphp\Html\Head;

$head = (new Head("Document title", "utf-8"));
$head->setBaseAddr("http://sphp.samiholck.com/", "_self")
        ->addShortcutIcon("sph/favicon.ico")
        ->addMeta(Meta::author('Sami Holck'))
        ->addMeta(Meta::applicationName('SPHP framework'))
        ->addMeta(Meta::keywords(
                        ['php', 'scss', 'css', 'html', 'html5', 'javascript', 'jquery']))
        ->addMeta(Meta::description('SPHP framework for web developement'));
$head->printHtml();
