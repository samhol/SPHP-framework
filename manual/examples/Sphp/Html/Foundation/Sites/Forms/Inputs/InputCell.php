<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Foundation\Sites\Buttons\Button;

$form = (new GridForm())
        ->useValidation(true);
$usernameField = (new TextInput("username"))->setPlaceholder("Username");
$row1 = new FormRow();
$row1->append((new BasicInputCell((new TextInput("username"))
                        ->setPlaceholder("Username")
                        ->setRequired(), ['small-12', 'large-4']))
                ->setHelperText("Insert username *")
                ->setErrorField("You need to insert a username")
                ->setLabel("Username:"));
$row1->append((new BasicInputCell((new TextInput("fname"))
                        ->setRequired()
                        ->setPlaceholder("First name"), ['small-12', 'large-4']))
                ->setLabel("First name:")
                ->setErrorField("You need to insert a username"));
$row1->append((new BasicInputCell((new TextInput("lname"))
                        ->setRequired()
                        ->setPlaceholder("Family name"), ['small-12', 'large-4']))
                ->setErrorField("You need to insert a username")
                ->setLabel("Family name:"));
$form->append($row1);

$form->append($ta = BasicInputCell::textarea("description", null, 5));
$ta->getInput()->setRequired()
        ->setPlaceholder("Something about yourself");
$ta->setErrorField("Yuo need to write something about yourself");

$form->append(Button::submitter("Submit form", "submit"));

$form->printHtml();
