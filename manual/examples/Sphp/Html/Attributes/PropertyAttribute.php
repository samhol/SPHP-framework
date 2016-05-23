<?php

namespace Sphp\Html\Attributes;

$styles = (new PropertyAttribute("style"))
        ->set("color: #000; background: #fff;")
        ->setProperty("font-size", ".6em")
        ->setProperties([
            "display" => "block;",
            "border" => "solid 2px #ccc"
        ]);
$styles["flex"] = 1;
echo "<p $styles>Styled paragraph</p>\n";

$styles->lockProperty("visibility", "visible;")
        ->clear();
echo "<p $styles>Plain visible paragraph</p>";
?>