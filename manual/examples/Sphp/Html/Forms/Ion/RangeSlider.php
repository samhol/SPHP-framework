<?php

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Forms\Form as Form;

$form = new Form();
$form->validation(false)
        ->append((new RangeSlider("Weight", 0, 100, 1))
                ->useGrid(true)
                ->setPostfix("kg")
                ->setValue(50, 60))
        ->append((new RangeSlider("temperature", -100, 100, 1))
                ->useGrid(true)
                ->setPostfix("&deg;C")
                ->setValue([20, 30]))
        ->append((new RangeSlider("tempRange", 0, 40, 1))
                ->useGrid(true)
                ->setPostfix("&deg;C")
                ->setValue("20;35"))
        ->printHtml();
