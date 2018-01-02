<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;

$weight = (new Slider())
        ->setName("weight")
        ->setVertical();

$hours = (new Slider(0, 23, 1))
        ->setName("hours");

$score = (new Slider(0, 100, 50, 2))
        ->setName("score")
        ->setSubmitValue(12);
//->showValue();

$distance = (new Slider(10, 1000, 10, 10))
        ->setName("distance")
        ->setSubmitValue(100);
$bind = $distance->bindInput();
(new GridForm())
        ->append((new FormRow())
                ->appendColumn($weight, ['small-2'])
                ->appendColumn([$hours, $score, $distance, $bind], ['small-10']))
        ->printHtml();
?>
