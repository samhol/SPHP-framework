<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

$placeholder = new Attribute("placeholder", "Give your name");
$type = (new Attribute("type"))->protect("text");
$name = new Attribute("name", "foo");
$value = new Attribute("value", "");
$id = new IdAttribute("id", "name");
$required = (new BooleanAttribute("required", true));
echo "<input $placeholder $type $name $id $value $required>\n";

try {
  $type->set("email");
  echo "<input $placeholder $type $name $id $value $required>\n";
} catch (\Exception $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
