<?php

namespace Sphp\Html\Foundation\F6\Navigation;

$accordionMenu = (new AccordionMenu("Navigator"))
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.bing.com/", "Bing", "_blank");

$accordionMenu->appendSubMenu()
        ->setRoot("More Google")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank")
        ->appendLink("http://www.google.com/", "Google", "_blank");
$accordionMenu->printHtml();

