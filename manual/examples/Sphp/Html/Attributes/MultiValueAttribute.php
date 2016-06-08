<?php

namespace Sphp\Html\Attributes;

$observer = function($classes, $name) {
  if ($classes->count() == 0) {
    $content = "Empty $name attribute";
  } else {
    $content = $classes->getValue();
  }
  echo "<div $classes>$content</div>\n";
};
$classes = (new MultiValueAttribute("class"))
        ->attachAttributeChangeObserver($observer);
$classes->demand();
$classes->set("button tiny")
        ->add("radius")
        ->add(["alert"]);
$classes->lock("button")->remove("tiny");
$classes->clear();
?>