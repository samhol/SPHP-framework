<?php

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Forms\Form;

$form = new Form();
$form->validation(false)
        ->append((new RangeSlider("weightRange", 0, 100, 1))
                ->useGrid(true)
                ->setPostfix("kg")
                ->setSubmitValue(50, 60))
        ->append((new RangeSlider("tempRange", -100, 100, 1))
                ->useGrid(true)
                ->setPostfix("&deg;C")
                ->setSubmitValue([20, 30]))
        ->append((new RangeSlider("tempRange", 0, 40, 1))
                ->useGrid(true)
                ->setPostfix("&deg;C")
                ->setSubmitValue("20;35"))
        ->printHtml();
