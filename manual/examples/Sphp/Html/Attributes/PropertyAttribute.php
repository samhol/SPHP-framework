<?php

namespace Sphp\Html\Attributes;

$styles = (new PropertyAttribute("style"))
        ->set("color: #c00; padding: .5em;")
        ->setProperty("font-size", "1.6em")
        ->setProperties([
            "font-weight" => "bold",
            "border" => "dotted 2px #ccc"
        ]);
$styles["text-align"] = "justify";
echo "<p $styles>Styled paragraph</p>\n";
?>