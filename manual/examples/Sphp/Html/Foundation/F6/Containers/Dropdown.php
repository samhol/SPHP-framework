<?php

namespace Sphp\Html\Foundation\F6\Containers;

use Sphp\Html\Media\Img as Image;
use Sphp\Html\Foundation\F6\Grids\Grid as Grid;
use Sphp\Html\Span as Span;
use Sphp\Html\Forms\Buttons\Button as Button;

$img = Image::scale("manual/pics/error.png", .2)
        ->setAlt("Skull and bones 0.5x");
$dropdown1 = (new Dropdown(new Span("&lt;span&gt;"), clone $img))
        ->setSize("tiny");
$dropdown2 = (new Dropdown(new Button("button", "&lt;button&gt;", "button")))
        ->ajaxAppend("manual/snippets/loremipsum.html #par_1")
        ->closeOnBodyClick(true);
$dropdown3 = clone $dropdown2;
$dropdown3->setTarget($img)
        ->closeOnBodyClick(false);
$dropdown3[] = clone $img;

$grid = (new Grid());
$grid[] = "$dropdown1 $dropdown2 $dropdown3";
$grid->printHtml();
?>
