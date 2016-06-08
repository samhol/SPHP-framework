<?php

namespace Sphp\Html\Foundation\F6\Forms;

$weight = (new Slider())
        ->setVertical()
        ->setDescription("Weight")
        // ->showValue()
        ->setValueUnit("kg");

$hours = (new Slider(0, 23, 1))
        //->showValue()
        ->setDescription("hour of the day:");

$score = (new Slider(0, 100, 2))
        ->setDescription("two point score:")
        ->setValue(12);
        //->showValue();

$distance = (new Slider(10, 1000, 1))
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
