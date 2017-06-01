<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Media\Img;
use Sphp\Html\Div;

$img = new Img("http://via.placeholder.com/150/ccc/444/?text=example", "Placeholder Image");
$dropdown1 = (new Dropdown('Dropdown 1', $img))
        ->setSize("large");
$dropdown1->getTarget()->addCssClass('button');
$dropdown1->printHtml();
$dd = (new Div())->ajaxAppend("manual/snippets/loremipsum.html #par_1");
$dropdown2 = (new Dropdown('Dropdown 2', $dd))
        ->closeOnBodyClick(true);
$dropdown2->getTarget()->addCssClass('button');
$dropdown2->printHtml();
