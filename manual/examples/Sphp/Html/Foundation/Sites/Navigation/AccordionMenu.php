<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$accordionMenu = (new AccordionMenu("Navigator"));

$accordionMenu->appendSubMenu()
        ->setRoot("Google services")
        ->nested()
        ->appendLink("https://www.google.com/", "Google search", "_blank")
        ->appendLink("https://maps.google.com/", "Google maps", "_blank")
        ->appendLink("https://mail.google.com/", "Google mail", "_blank");
$accordionMenu
        ->appendLink("http://www.bing.com/", "Bing", "_blank")->printHtml();

