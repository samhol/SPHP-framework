<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\Sites\Grids\Grid as Grid;

$inlineStyles = [
    "overflow" => "auto",
    "width" => "100%",
    "height" => "373px;"];
$iframe = new Iframe();
$iframe->setSrc("http://sphp.samiholck.com/HtmlWiki.html")
        ->setLazy()
        ->setStyles($inlineStyles);
$widget = (new Iframe("http://193.64.245.223/basket/widget/"))
        ->setStyles($inlineStyles)
        ->setLazy()
        ->setStyle("border", "none");
$grid = new Grid([$iframe, $widget]);
$grid->printHtml();
?>
