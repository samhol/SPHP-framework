<?php

namespace Sphp\Html\Foundation\F6\Forms;

$weight = (new RangeSlider())
        ->setVertical()
        ->setDescription("Weight")
        // ->showValue()
        ->setValueUnit("kg");

$hours = (new RangeSlider(0, 23, 1))
        //->showValue()
        ->setDescription("hour of the day:");

$score = (new RangeSlider(0, 100, 50, 2))
        ->setDescription("two point score:")
        ->setValue(12);
        //->showValue();

$distance = (new RangeSlider(10, 1000, 10, 10))
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
