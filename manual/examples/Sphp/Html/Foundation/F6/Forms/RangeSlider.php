<?php

namespace Sphp\Html\Foundation\F6\Forms;

$weight = (new RangeSlider("rate"))
        ->setVertical()
        ->setDescription("Weight")
        // ->showValue()
        ->setValueUnit("kg");

$hours = (new RangeSlider("hour", 0, 23, 1))
        //->showValue()
        ->setDescription("hour of the day:");

$score = (new RangeSlider("triple", 0, 99, 3))
        ->setDescription("two point score:")
        ->setValue(12);
        //->showValue();

$distance = (new RangeSlider("distance", 10, 1000, 1))
        ->setDescription("Distance travelled:")
        ->setValue(100)
        //->showValue()
        ->setValueUnit("km");

$form = new GridForm("url", "post");
$form[] = (new FormRow())
        ->appendColumn($weight, 2)
        ->appendColumn([$hours, $score, $distance], 10);
echo $form;
?>
