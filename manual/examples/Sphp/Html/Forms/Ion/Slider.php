<?php

namespace Sphp\Html\Forms\Ion;

use Sphp\Html\Forms\Form as Form;

$form = new Form();
$form[] = (new IonSlider("Weight", 0, 100, 1))
        ->useGrid(true)
        ->setPostfix("kg")
        ->setValue(50);
$form[] = (new IonSlider("temperature", -100, 100, 1))
        ->useGrid(true)
        ->setPostfix("&deg;C")
        ->setValue(20);
$form[] = (new IonSlider("tempRange", 0, 40, 1))
        ->useGrid(true)
        ->setPostfix("&deg;C")
        ->setValue(20);

$form->printHtml();
?>
