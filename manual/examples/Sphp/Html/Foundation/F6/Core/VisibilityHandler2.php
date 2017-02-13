<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Document;

$ul = Document::get("ul");
foreach (Screen::sizes() as $size) {
  $li = "$size screen size: ";
  $li .= (new VisibilityAdapter(Document::get("span", "yes")))
          ->showOnlyFor($size);
  $li .= (new VisibilityAdapter(Document::get("span", "no")))
          ->hideOnlyFromSize($size);
  $ul[] = $li;
}
$ul->printHtml();
?>