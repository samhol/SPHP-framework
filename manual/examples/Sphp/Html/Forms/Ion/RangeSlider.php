<?php

namespace Sphp\Html\Forms\Ion;

use Sphp\Html\Forms\Form as Form;

$form = new Form();
$form[] = (new RangeSlider("Weight", 0, 100, 1))
        ->useGrid(true)
        ->setPostfix("kg")
        ->setValue(50, 60);
$form[] = (new RangeSlider("temperature", -100, 100, 1))
        ->useGrid(true)
        ->setPostfix("&deg;C")
        ->setValue([20, 30]);
$form[] = (new RangeSlider("tempRange", 0, 40, 1))
        ->useGrid(true)
        ->setPostfix("&deg;C")
        ->setValue("20;35");

$form->printHtml();
?>
