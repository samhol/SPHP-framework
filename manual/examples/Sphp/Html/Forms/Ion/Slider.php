<?php

namespace Sphp\Html\Forms\Inputs\Ion;

use Sphp\Html\Forms\Form;

$form = new Form();
$form[] = (new Slider("weight", 0, 100, 1))
        ->useGrid(true)
        ->setPostfix("kg")
        ->setSubmitValue(50);
$form[] = (new Slider("temperature", -100, 100, 1))
        ->useGrid(true)
        ->setPostfix("&deg;C")
        ->setSubmitValue(20);

$form->printHtml();
