<?php

namespace Sphp\Html\Forms;

$form = new Form();
$form[] = (new IonRangeSlider("Weight", 0, 100, 1))
		->useGrid(true)
		->setOption("postfix", "kg")
		->setValue(50);
$form[] = (new IonRangeSlider("temperature", -100, 100, 1))
		->useGrid(true)
		->setOption("postfix", "&deg;C")
		->setValue(20);
$form[] = (new IonRangeSlider("tempRange", 0, 40, 1))
		->useGrid(true)
		->setOption("postfix", "&deg;C")
		->setValue(20)
		->setType("double");

$form->printHtml();
?>
