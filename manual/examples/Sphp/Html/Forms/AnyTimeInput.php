<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form;
use Sphp\Html\Forms\Label;

$datetimeInput = (new AnyTimeInput("datetime"))
        ->setPlaceholder("what ever time...")->setLocale('fi');

$form = (new Form());

$form[] = new Label("what ever time...", $datetimeInput);
$form[] = $datetimeInput;
$form->printHtml();
