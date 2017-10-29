<?php

namespace Sphp\Html\Attributes;

$classes = (new ClassAttribute("class"));
$id = new IdentityAttribute('id');
$bool = (new BooleanAttribute("disabled"));
$classes->set("button", "tiny")->add(["alert", "foo"]);
$bool->set(true);
echo "<button $classes $bool $id>button</button>\n";
$id->set('foo-button');
$bool->set(false);
$classes->remove("tiny");
echo "<button $classes $bool $id>button</button>\n";
$bool->protect(true);
$classes->protect('button')->clear();
echo "<button $classes $bool $id>button</button>\n";


$classes->add("alert", "tiny")->filterPattern("/^[^a-zA-Z]+$/");
echo "<button $classes $bool $id>button</button>\n";













