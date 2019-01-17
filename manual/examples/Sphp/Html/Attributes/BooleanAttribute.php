<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;

$placeholder = new GeneralAttribute("placeholder", "Give your name");
$type = (new GeneralAttribute("type"))->protect("text");
$name = new GeneralAttribute("name", "foo");
$value = new GeneralAttribute("value", "");
$id = new IdAttribute("id", "name");
$required = (new BooleanAttribute("required", true));
echo "<input $placeholder $type $name $id $value $required>\n";

try {
  $type->setValue("email");
  echo "<input $placeholder $type $name $id $value $required>\n";
} catch (\Exception $ex) {
  echo ThrowableCalloutBuilder::build($ex);
}
