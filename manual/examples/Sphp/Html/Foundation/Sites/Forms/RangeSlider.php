<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm as GridForm;

$hours = (new RangeSlider("hour", 0, 23, 1))
        //->showValue()
        ->setDescription("hour of the day:");

$score = (new RangeSlider("triple", 0, 99, 3))
        ->setDescription("two point score:")
        ->setSubmitValue(12);
//->showValue();

$distance = (new RangeSlider("distance", 100, 200, 1))
        ->setDescription("Distance travelled:")
        ->setSubmitValue([120, 150])
        //->showValue()
        ->setValueUnit("km");

$form = new GridForm();
$form->append([$hours, $score, $distance]);
echo $form;
?>
