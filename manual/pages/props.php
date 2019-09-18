<?php

use Sphp\Manual\Apps\Icons\Data\DataFactory;
use Sphp\Manual\Apps\Icons\IconGroup;
use Sphp\Manual\Apps\Icons\FaIconGroup;
use Sphp\Stdlib\Parsers\ParseFactory;

echo '<pre>';
$foo = DataFactory::deviconsFromJson('/home/int48291/public_html/playground/manual/snippets/icons/devicon/devicon.json');
foreach ($foo as $name => $group) {
  //print_r($group);
  foreach ($group->getIcons() as $k => $icon) {
    if ($icon->isSvg()) {
      echo $icon->getProperty('name') . '-' . $icon->getProperty('style') . "\n";
      //print_r($icon);
    }
    //echo $icon->createIcon();
  }
}
