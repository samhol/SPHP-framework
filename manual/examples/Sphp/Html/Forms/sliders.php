<?php

namespace Sphp\Html\Forms\Foundation;

use Sphp\Html\Foundation\Structure\Row as Row;
use Sphp\Html\Foundation\Structure\Column as Column;
use Sphp\Html\Forms\Buttons\SubmitButton as SubmitButton;

$weight = (new RangeSlider())
		->setVertical()
		->setDescription("Weight")
		->showValue()
		->setValueUnit("kg");

$hours = (new RangeSlider(0, 23, 1))
		->showValue()
		->setDescription("hour of the day:");

$score = (new RangeSlider(0, 100, 2))
		->setDescription("two point score:")
		->setValue(12)->showValue();

$distance = (new RangeSlider(10, 1000, 1))
			->setDescription("Distance travelled:")
			->setValue(100)
			->showValue()
			->setValueUnit("km");

$form = new GridForm("url", "post");
$form[] = (new Row())
		->appendColumn($weight, 2)
		->appendColumn([$hours, $score, $distance], 10);
//$buttonBar = new \Sphp\Html\Foundation\Buttons\ButtonGroup();
//$buttonBar->appendFormButton("Submit", "submit", "__submit__", "__submit.form__")
//		->appendFormButton("Reset", "reset");
//$form[] = (new Column($buttonBar->setSize("small")))->setCssClass("panel");
echo $form;

?>