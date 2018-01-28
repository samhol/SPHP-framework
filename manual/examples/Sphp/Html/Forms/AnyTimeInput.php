<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form;
use Sphp\Html\Forms\Label;

$datetimeInput = (new AnyTimeInput("datetime"))
                ->setPlaceholder("what ever date and time...")->setLocale('fi_FI');
$dateInput = (new AnyTimeInput("date"))->setDateTimeFormat('%Y-%m-%d')
        ->setPlaceholder("what ever time..."); //->setLocale('fi_FI');

$form = (new Form());

$form[] = new Label("what ever time...", $datetimeInput);
$form[] = $datetimeInput;
$form[] = $dateInput;
$form->printHtml();
