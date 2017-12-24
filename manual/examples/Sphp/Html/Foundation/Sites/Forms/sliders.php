<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;

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
        ->setSubmitValue(12);
//->showValue();

$distance = (new Slider(10, 1000, 10, 10))
        //->setDescription("Distance travelled:")
        ->setSubmitValue(100);
//->setValueUnit("km");

(new GridForm())
        ->append((new FormRow())
                ->appendColumn($weight, ['small-2'])
                ->appendColumn([$hours, $score, $distance], ['small-10']))
        ->printHtml();
?>
