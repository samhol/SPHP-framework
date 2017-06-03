<?php

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Forms\Form as Form;

$form = new Form();
$form[] = (new Slider("Weight", 0, 100, 1))
        ->useGrid(true)
        ->setPostfix("kg")
        ->setValue(50);
$form[] = (new Slider("temperature", -100, 100, 1))
        ->useGrid(true)
        ->setPostfix("&deg;C")
        ->setValue(20);
$form[] = (new Slider("tempRange", 0, 40, 1))
        ->useGrid(true)
        ->setPostfix("&deg;C")
        ->setValue(20);

$form->printHtml();
