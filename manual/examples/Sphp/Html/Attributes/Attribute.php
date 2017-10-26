<?php

namespace Sphp\Html\Attributes;

$placeholder = new Attribute("placeholder", "Give your name");
$type = (new Attribute("type"))->lock("text");
$name = new Attribute("name", "foo");
$value = new Attribute("value", "");
$id = new Attribute("id", "name");
$required = (new BooleanAttribute("required", true));
echo "<input $placeholder $type $name $id $value $required>\n";

use Sphp\Html\Foundation\Sites\Containers\ThrowableCallout;

try {
  $type->set("email");
  echo "<input $placeholder $type $name $id $value $required>\n";
} catch (\Exception $ex) {
  echo new ThrowableCallout($ex);
}
