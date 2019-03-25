<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs\Sliders;

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;

$weight = (new Slider())
        ->setName("weight")
        ->setVertical();

$hours = (new Slider(0, 23, 1))
        ->setName("hours");

$score = (new Slider(0, 100, 50, 2))
        ->setName("score")
        ->setInitialValue(12);
//->showValue();

$distance = (new Slider(10, 1000, 10, 10))
        ->setName("distance")
        ->setInitialValue(100);
$bind = $distance->bindInput();
$row = (new FormRow());
$row->appendCell($weight, ['shrink']);
$row->appendCell([$hours, $score, $distance, $bind], ['auto']);
(new GridForm())
        ->append($row)
        ->printHtml();
?>
