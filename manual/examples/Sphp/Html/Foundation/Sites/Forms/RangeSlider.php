<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm;

$hours = (new RangeSlider("hour", 0, 23, 1));

$score = (new RangeSlider("triple", 0, 99, 3))
        ->setSubmitValue(12);

$distance = (new RangeSlider("distance", 100, 200, .5))
        ->setSubmitValue([120, 150]);

$form = new GridForm();
$form->append([$hours, $score, $distance]);
echo $form;
