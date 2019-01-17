<?php

namespace Sphp\Html\Attributes;

$styles = (new PropertyCollectionAttribute("style"))
        ->setValue("color: #c00; padding: .5em;")
        ->setProperty("font-size", "1.6em")
        ->setProperties([
            "font-weight" => "bold",
            "border" => "dotted 2px #ccc"
        ]);
echo "<p $styles>Styled paragraph</p>\n";
$styles["text-align"] = "right";
echo "<p $styles>Styled paragraph</p>\n";
