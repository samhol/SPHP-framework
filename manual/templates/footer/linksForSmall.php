<?php

use Sphp\Html\Foundation\Sites\Navigation\FlexibleMenu;

$accordion = FlexibleMenu::createAccordion();
$accordion->addCssClass('sphp')->addCssClass('hide-for-medium');
$mb->buildMenu($footerData, $accordion);
$accordion->setOption('slideSpeed', 600);
echo $accordion;
