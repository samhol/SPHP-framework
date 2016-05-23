<?php

namespace Sphp\Html\Attributes;

$observer = function($attrs) {
  echo "<input $attrs>\n";
};
$attrs = (new AttributeManager())
        ->set("value", "SPHP button")
        ->attachAttributeChangeObserver($observer);
$attrs["type"] = "button";
$attrs["style"]["width"] = "50%";
$attrs["class"] = "button";
$attrs["style"]->set(FALSE);
echo "<input $attrs>\n";
?>