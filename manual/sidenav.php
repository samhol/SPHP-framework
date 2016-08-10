<?php

namespace Sphp\Html\Foundation\F6\Navigation;

ob_start();

use Sphp\Core\Configuration as Configuration;
include_once 'links.php';
$nav = (new AccordionMenu())->addCssClass("sphp-sidenav")->appendText("Documentation");
$nav[0]->addCssClass("heading");
//$nav->append($downloadBtn);
$sidenavLinker = function (array $link) use($nav) {
  if (array_key_exists("href", $link)) {
    $text = array_key_exists("text", $link) ? $link["text"] : $link["href"];
    $target = array_key_exists("target", $link) ? $link["target"] : "_self";
    $nav->appendLink($link["href"], $text, $target);
  }
};

foreach (Configuration::useDomain("manual")->get("SIDENAV_LINKS") as $item) {
  if (array_key_exists("href", $item)) {
    $sidenavLinker($item);
  } else if (array_key_exists("group", $item) && array_key_exists("sub", $item)) {
    $accordion = new SubMenu($item["group"]);
    foreach ($item["sub"] as $link) {
      if (array_key_exists("href", $link)) {
        $text = array_key_exists("text", $link) ? $link["text"] : $link["href"];
        $target = array_key_exists("target", $link) ? $link["target"] : "_self";
        $accordion->appendLink($link["href"], $text, $target);
      }
    }
    $nav->append($accordion);
  }
}

echo $nav;
$content = ob_get_contents();

ob_end_clean();

echo $content;
unset($nav, $content);

