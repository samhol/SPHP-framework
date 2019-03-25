<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs\Sliders;

use Sphp\Html\Foundation\Sites\Forms\GridForm;

$hours = (new RangeSlider("hour", 0, 23, 1));

$score = (new RangeSlider("triple", 0, 99, 3))
        ->setInitialValue(12);

$distance = (new RangeSlider("distance", 100, 200, .5))
        ->setInitialValue([120, 150]);

$form = new GridForm();
$form->getGrid()->setFull();
$form->append([$hours, $score, $distance . $distance->buildValueViewer()])->useMargin(true);
echo $form;
