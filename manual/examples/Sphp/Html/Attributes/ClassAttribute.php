<?php

namespace Sphp\Html\Attributes;

$classes = (new ClassAttribute())
        ->set("button", "tiny")
        ->add(["alert", "disabled"]);
echo "<button $classes>button</button>\n";

$classes->remove("disabled", "alert");
echo "<button $classes>button</button>\n";

$classes->protect('button', "success")->clear();
echo "<button $classes>button</button>\n";
