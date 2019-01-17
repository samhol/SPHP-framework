<?php

namespace Sphp\Html\Attributes;

$placeholder = new GeneralAttribute("placeholder", "Give your name");
$type = (new PatternAttribute("type", "/^text|email|number*$/"))->setValue("text");
$name = new GeneralAttribute("name", "foo");
$required = new BooleanAttribute("required", true);
echo "<input $placeholder $type $name $required>\n";

$id = new IdAttribute();
$id->identify();
$value = new GeneralAttribute("value", "Sami Holck");
echo "<input $placeholder $type $name $id $value $required>\n";
