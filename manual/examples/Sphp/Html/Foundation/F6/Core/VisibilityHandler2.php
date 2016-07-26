<?php

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Document as Document;

$ul = Document::get("ul");
foreach (Screen::sizes() as $size) {
  $li = "$size screen size: ";
  $li .= (new VisibilityHandler(Document::get("span", "yes")))
          ->showOnlyFor($size);
  $li .= (new VisibilityHandler(Document::get("span", "no")))
          ->hideOnlyFromSize($size);
  $ul[] = $li;
}
$ul->printHtml();
?>