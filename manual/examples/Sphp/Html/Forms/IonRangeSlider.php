<?php

namespace Sphp\Html\Forms;

$form = new Form();
$form[] = new IonRangeSlider("Weight", 0, 100, 10);
$form[] = (new IonRangeSlider("Weight", 0, 100, 1))
		->setOption("hasGrid", true)
		->setOption("postfix", "kg")
		->setValue(50)
		->setLabel("Weight");
$form[] = (new IonRangeSlider("temperature", -100, 100, 1))
		->setOption("hasGrid", true)
		->setOption("postfix", "&deg;C")
		->setValue(20)
		->setLabel("Temperature:");
$form[] = (new IonRangeSlider("tempRange", 0, 40, 1))
		->setOption("hasGrid", true)
		->setOption("postfix", "&deg;C")
		->setValue(20)
		->setOption("type", "double")
		->setLabel("Temperature:");

$form->printHtml();
?>