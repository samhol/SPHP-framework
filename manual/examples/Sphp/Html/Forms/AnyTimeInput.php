<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form as Form;
use Sphp\Html\Foundation\F6\Forms\Buttons\SubmitButton as SubmitButton;
$datetimeInput = (new AnyTimeInput("datetime"))
        ->setPlaceholder("what ever time...")
        ->setRequired();

$form = (new Form());

$form[] = $datetimeInput->createLabel("what ever time...");
$form[] = $datetimeInput;
$form[] = new SubmitButton("submit");
$form->printHtml();
?>
