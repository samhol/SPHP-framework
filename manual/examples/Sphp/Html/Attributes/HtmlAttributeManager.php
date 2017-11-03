<?php

namespace Sphp\Html\Attributes;

$attrs = new HtmlAttributeManager();
$attrs->protect("type", "text");
echo "<input $attrs>\n";
$attrs->set("value", "Sami")
        ->set("disabled", true);
echo "<input $attrs>\n";
$attrs->identify(32);
echo "<input $attrs>\n";
$attrs->remove("disabled");
echo "<input $attrs>\n";
$attrs->set("value", false);
$attrs->setInstance(new BooleanAttribute('required', true));
echo "<input $attrs>\n";
$attrs->set("placeholder", "First Name");
echo "<input $attrs>\n";
