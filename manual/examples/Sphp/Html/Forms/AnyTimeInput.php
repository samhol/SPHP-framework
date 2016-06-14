<?php

namespace Sphp\Html\Forms;


//use Sphp\Html\Forms\Textarea as Textarea;

$datetimeInput = (new Input\AnyTimeInput("datetime"))
        ->setPlaceholder("what ever time...")
        ->setLabel("What ever time...");



$form = (new Form());

$form[] = $datetimeInput;

$form->printHtml();
?>