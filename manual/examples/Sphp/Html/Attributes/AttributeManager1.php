<?php

namespace Sphp\Html\Attributes;

$observer = function($attrs) {
  echo "<input $attrs>\n";
};
$attrs = (new AttributeManager())
        ->set("type", "button")
        ->attachAttributeChangeObserver($observer);
$attrs["value"] = "Sami";
$attrs["disabled"] = TRUE;
$attrs->remove("not_found");
$attrs->remove("disabled");
$attrs["type"] = "text";
$attrs["value"] = FALSE;
$attrs["placeholder"] = "First Name";
?>