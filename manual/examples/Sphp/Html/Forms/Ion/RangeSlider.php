<?php

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Forms\Form;

$form = new Form();
$form->validation(false)
        ->append((new RangeSlider("weightRange", 0, 10, .5))
                ->useGrid(true)
                ->setPostfix("kg")
                ->setInitialRange(1.5, 8))
        ->append((new RangeSlider("heightRange", 0, 300, 5))
                ->useGrid(true)
                ->setPostfix("cm"))
        ->append((new RangeSlider("tempRange2", -100, 100, 1))
                ->useGrid(true)
                ->setPostfix("&deg;C")
                ->setInitialRange(-20, 60))
        ->printHtml();
