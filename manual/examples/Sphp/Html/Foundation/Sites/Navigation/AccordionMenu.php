<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$accordionMenu = FlexibleMenu::createAccordion('accordion')->addCssClass('sphp');;

$sub = $accordionMenu->appendSubMenu()->setRoot('Search Engines');
$sub->nested();
$sub->appendLink("https://www.google.com/", 'Google search', "_blank");
$sub->appendLink("https://maps.google.com/", 'Google maps', "_blank");
$sub->appendLink("https://mail.google.com/", 'Google mail', "_blank");
$sub->appendRuler();
$sub->appendLink("http://www.bing.com/", "Bing", "_blank");
$accordionMenu->printHtml();

