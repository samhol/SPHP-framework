<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

$drilldownMenu = FlexibleMenu::createDrilldown()->addCssClass('sphp');
$drilldownMenu->setAttribute('data-back-button', '&lt;li class&#x3D;&quot;js-drilldown-back&quot;&gt;&lt;a tabindex&#x3D;&quot;0&quot;&gt;Back&lt;/a&gt;&lt;/li&gt;');
$drilldownMenu->appendLink("#Item1", "Item 1", "_self");
$drilldownMenu->appendLink("#Item2", "Item 2", "_self");
$submenu = $drilldownMenu->appendSubMenu()->setRoot('Item 3');
$submenu->appendLink("#Item3.1", "Item 3.1", "_self");
$submenu->appendLink("#Item3.2", "Item 3.2", "_self");
$submenu->appendLink("#Item3.3", "Item 3.3", "_self");
$submenu->appendLink("#Item3.4", "Item 3.4", "_self");
$drilldownMenu->printHtml();
