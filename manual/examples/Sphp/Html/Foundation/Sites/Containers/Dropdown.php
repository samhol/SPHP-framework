<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Media\Img as Image;
use Sphp\Html\Foundation\Sites\Grids\Grid as Grid;
use Sphp\Html\Span;
use Sphp\Html\Forms\Buttons\ButtonTag as Button;

$img = Image::scale("manual/pics/error.png", .2)
        ->setAlt("Skull and bones 0.5x");
$dropdown1 = (new Dropdown(new Span("&lt;span&gt;"), clone $img))
        ->setSize("tiny");
$dropdown2 = (new Dropdown(new Button("button", "&lt;button&gt;", "button")))
        ->ajaxAppend("manual/snippets/loremipsum.html #par_1")
        ->closeOnBodyClick(true);

$grid = (new Grid());
$grid[] = "$dropdown1 $dropdown2";
$grid->printHtml();
?>
