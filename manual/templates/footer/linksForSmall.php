<?php

use Sphp\Html\Foundation\Sites\Navigation\MenuBuilder;
use Sphp\Html\Foundation\Sites\Navigation\FlexibleMenu;

$mb = new MenuBuilder();
echo $mb->buildMenu($footerData, FlexibleMenu::createAccordion())->addCssClass('sphp')->addCssClass('hide-for-medium');
