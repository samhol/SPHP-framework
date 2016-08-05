<?php

namespace Sphp\Html\Foundation\F6\Forms;

$weight = (new Slider())
        ->setName("weight")
        ->setVertical()
        //->setDescription("Weight")
        // ->showValue()
        ->setValueUnit("kg");

$hours = (new Slider(0, 23, 1));
        //->showValue()
        //->setDescription("hour of the day:");

$score = (new Slider(0, 100, 50, 2))
        //->setDescription("two point score:")
        ->setValue(12);
//->showValue();

$distance = (new Slider(10, 1000, 10, 10))
        //->setDescription("Distance travelled:")
        ->setValue(100);
        //->setValueUnit("km");

(new GridForm())
        ->append((new FormRow())
                ->appendColumn($weight, 2)
                ->appendColumn([$hours, $score, $distance], 10))
        ->printHtml();
?>
