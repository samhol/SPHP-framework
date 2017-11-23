<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form;

$form = new Form();
$number = Input::number("number")
        ->setPlaceholder("Number field")
        ->setStep(5)
        ->setMinimum(-10)
        ->setMaximum(10);
$form[] = $number;
$form[] = Input::text("text")
        ->setPlaceholder("Text field");
$form[] = Input::email("email")
        ->setPlaceholder("Email field");
$form[] = Input::password("password")
        ->setPlaceholder("Password field");
$form[] = Input::textarea("textarea")
        ->setPlaceholder("Textarea field")
        ->setRows(5);
$form[] = Input::select("select")
        ->appendOption("opt1", "Option 1.")
        ->appendOption("opt2", "Option 2.");

$form->printHtml();
