<?php

namespace Sphp\Html\Attributes;

$classes = (new ClassAttribute())
        ->set("button", "tiny")
        ->add(["alert", "disabled"]);
echo "<button $classes>button</button>\n";
$classes->remove("tiny");
echo "<button $classes>button</button>\n";
$classes->protect('button')->clear();
echo "<button $classes>button</button>\n";


$classes->add("alert", "tiny", "disabled");
echo "<button $classes>button</button>\n";













