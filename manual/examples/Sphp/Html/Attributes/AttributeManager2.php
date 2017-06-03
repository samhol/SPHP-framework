<?php

namespace Sphp\Html\Attributes;

$attrs = new AttributeManager();
$attrs->lock("type", "text");
$attrs->set("value", "Hello");
echo "<input $attrs>\n";
$attrs->styles()->setProperty("width", "50%");
echo "<input $attrs>\n";
$attrs->styles()->set("width", false);
echo "<input $attrs>\n";
