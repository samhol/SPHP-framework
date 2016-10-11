<?php

namespace Sphp\Html\Attributes;

$classes = (new MultiValueAttribute("class"));

$classes->set("button tiny")->add(["alert", "foo"]);
echo "<button $classes>Classy button</button>\n";

$classes->lock('button')->remove("tiny");
echo "<button $classes>Classy button</button>\n";
$classes->clear();
echo "<button $classes>Classy button</button>\n";
?>
