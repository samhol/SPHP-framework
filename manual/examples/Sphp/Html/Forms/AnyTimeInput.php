<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form as Form;

$datetimeInput = (new AnyTimeInput("datetime"))
        ->setPlaceholder("what ever time...");

$form = (new Form());

$form[] = $datetimeInput->createLabel("what ever time...");
$form[] = $datetimeInput;

$form->printHtml();
?>
