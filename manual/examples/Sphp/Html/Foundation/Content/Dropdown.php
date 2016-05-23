<?php

namespace Sphp\Html\Foundation\Content;

use Sphp\Html\Media\Img as Image;
use Sphp\Html\Foundation\Structure\Grid as Grid;
use Sphp\Html\Span as Span;
use Sphp\Html\Foundation\Buttons\FormButton as FormButton;

$img = Image::scale("sphpManual/pics/error.png", .5)
		->setAlt("Skull and bones 0.5x");
$dropdown1 = (new Dropdown(new Span("I have a Dropdown."), clone $img))
		->setPadding();
$dropdown2 = (new Dropdown(new FormButton("Button with dropdown", "button")))
		->ajaxAppend("http://sphp.samiholck.com/sphpManual/examples/loremipsum.html")
		->setSize("large")
		->align("top");
$dropdown3 = clone $dropdown2;
$dropdown3->setTarget($img)
		->align("left");
$dropdown3[] = clone $img;

$grid = (new Grid());
$grid[] = "$dropdown1 $dropdown2 $dropdown3";
$grid->printHtml();
?>