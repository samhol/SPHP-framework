<?php

namespace Sphp\Html\Attributes;

$placeholder = new Attribute("placeholder", "Give your name");
$type = (new PatternAttribute("type", "/^text|email|number*$/"))->set("text");
$name = new Attribute("name", "foo");
$required = new BooleanAttribute("required", true);
echo "<input $placeholder $type $name $required>\n";

$id = new IdAttribute();
$id->identify();
$value = new Attribute("value", "Sami Holck");
echo "<input $placeholder $type $name $id $value $required>\n";
