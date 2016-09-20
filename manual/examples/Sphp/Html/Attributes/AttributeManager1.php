<?php

namespace Sphp\Html\Attributes;

$attrs = new AttributeManager();
$printInput = function() use ($attrs) {
  echo "<input $attrs>\n";
};
$observer = function($id) {
  echo "<p>$id</p>\n";
};
$attrs->lock("type", "text")
        ->identify();
$attrs->set("value", "Sami");
$attrs->set("disabled", true);
$printInput();
$attrs->remove("not_found");
$attrs->remove("disabled");
$attrs->set("value", false);
$attrs->set("placeholder", "First Name");
$printInput($attrs);
?>
