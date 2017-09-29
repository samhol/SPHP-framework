<?php

namespace Sphp\Html\Attributes;

$attrs = new AttributeObjectManager([
    "class" => MultiValueAttribute::class,
    "style" => PropertyAttribute::class,
    "data-foo" => PropertyAttribute::class,
    "id" => IdentityAttribute::class,
    "data-id" => IdentityAttribute::class]);

$attrs->setValue("class", range("a", "e"))
        ->getObject("style")
            ->setProperty("border", "#000 solid 1px");
$attrs->getObject("id")->identify();
echo "<span $attrs>Foo Span</span>\n";
