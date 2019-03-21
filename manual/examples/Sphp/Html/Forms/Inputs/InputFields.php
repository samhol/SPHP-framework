<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form;

$form = new Form();
$form[] = "Number range between -10 and 10";
$number = FormControls::number("number")
        ->setStepLength(5)
        ->setRange(-10, 10);
$form[] = $number;
$form[] = FormControls::text("text")
        ->setPlaceholder("Text field");
$form[] = FormControls::email("email")
        ->setPlaceholder("Email field");
$form[] = FormControls::password("password")
        ->setPlaceholder("Password field");
$form[] = FormControls::textarea("textarea")
        ->setPlaceholder("Textarea field")
        ->setRows(5);

$select = FormControls::select("select");
$select->appendOption("opt1", "Option 1.");
$select->appendOption("opt2", "Option 2.");
$form[] = $select;

$form[] = FormControls::hidden("hidden", "value");
$form->printHtml();
