<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form;

$form = new Form();
$form[] = "Number range between -10 and 10";
$number = Factory::number("number")
        ->setStepLength(5)
        ->setRange(-10, 10);
$form[] = $number;
$form[] = Factory::text("text")
        ->setPlaceholder("Text field");
$form[] = Factory::email("email")
        ->setPlaceholder("Email field");
$form[] = Factory::password("password")
        ->setPlaceholder("Password field");
$form[] = Factory::textarea("textarea")
        ->setPlaceholder("Textarea field")
        ->setRows(5);

$select = Factory::select("select");
$select->appendOption("opt1", "Option 1.");
$select->appendOption("opt2", "Option 2.");
$form[] = $select;

$form[] = Factory::hidden("hidden", "value");
$form->printHtml();
