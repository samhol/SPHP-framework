<?php

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\Document;

$paragraph = Document::get('p');
$adapter = new VisibilityAdapter($paragraph);
foreach (array_reverse(Screen::sizes()) as $name) {
  $adapter->getComponent()->append("You are on a <b>$name</b> screen or larger.");
  echo $adapter->showFromUp($name);
  $paragraph->replaceContent("You are <em>definitely</em> on a <b>$name</b> screen.");
  echo $adapter->showOnlyFor($name);
  $paragraph->replaceContent("Visible from small to $name screens");
  echo $adapter
          ->hideDownTo($name);
}
foreach (Screen::sizes() as $name) {
  (new VisibilityAdapter(Document::get("p", "show Only For $name")))
          ->showOnlyFor($name)
          ->printHtml();
}
(new VisibilityAdapter(Document::get("p", "Show between small and large screens")))
        ->showBetweenSizes("small", "large")
        ->printHtml();
(new VisibilityAdapter(Document::get("p", "Show between medium and xlarge screens")))
        ->showBetweenSizes("medium", "xlarge")
        ->printHtml();
(new VisibilityAdapter(Document::get("p", "Show between medium and xxlarge screens")))
        ->showBetweenSizes("medium", "xxlarge")
        ->printHtml();
(new VisibilityAdapter(Document::get("p", "Hide from small and large screens")))
        ->hideOnlyFromSize("large")->hideOnlyFromSize("small")
        ->printHtml();
?>
