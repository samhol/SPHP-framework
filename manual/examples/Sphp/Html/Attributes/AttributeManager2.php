<?php

namespace Sphp\Html\Attributes;

$observer = function($attrs) {
  echo "<input $attrs>\n";
};
$attrs = new AttributeManager();
$attrs->set("value", "SPHP button")
        ->attachIdentityObserver($observer);
$attrs->lock("type", "button");
$attrs->styles()->setProperty("width", "50%");
$attrs->classes()->add("button");
$attrs->styles()->set("width", FALSE);
echo "<input $attrs>\n";
?>
