<?php

namespace Sphp\Html\Attributes;

$observer = function($attrs) {
  echo "<input $attrs>\n";
};
$attrs = (new AttributeManager())
        ->set("type", "button")
        ->attachAttributeChangeObserver($observer);
$attrs["value"] = "Sami";
$attrs["disabled"] = true;
$attrs->remove("not_found");
$attrs->remove("disabled");
$attrs["type"] = "text";
$attrs["value"] = false;
$attrs["placeholder"] = "First Name";
?>