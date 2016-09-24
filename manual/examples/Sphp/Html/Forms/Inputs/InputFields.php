<?php

namespace Sphp\Html\Forms\Inputs;

use Sphp\Html\Forms\Form;
use Sphp\Html\Forms\Inputs\Menus\Select;

$form = new Form();
$number = (new NumberInput("number"))
        ->setPlaceholder("Number field")
        ->setStep(5)
        ->setMinimum(-10)
        ->setMaximum(10);
$form[] = $number;
$form[] = (new TextInput("text"))
        ->setPlaceholder("Text field");
$form[] = (new EmailInput("email"))
        ->setPlaceholder("Email field");
$form[] = (new PasswordInput("password"))
        ->setPlaceholder("Password field");
$form[] = (new Textarea("textarea"))
        ->setPlaceholder("Textarea field")
        ->setRows(5);
$form[] = (new Select("select"))
        ->appendOption("opt1", "Option 1.")
        ->appendOption("opt2", "Option 2.");

$form->printHtml();
?>
