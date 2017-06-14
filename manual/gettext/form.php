<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Foundation\Sites\Forms\Inputs\Checkboxes;

$form = new GridForm('manual/gettext/index.php', 'get');

    $row = new FormRow();
$typeSelector = new Checkboxes('type', [0b1 => 'singular', 0b10 => 'plural']);
$typeSelector->setValue(['type' => ['1' , '2']]);
//$row = FormRow::from($typeSelector);
$form->append($typeSelector);
/*$typeInput = (new TextInput("username"))->setPlaceholder("Username");
$row1 = (new FormRow())
        ->append((new InputColumn((new TextInput("username"))
                ->setPlaceholder("Username")
                ->setRequired(), ['small-12', 'large-4']))
                ->setHelperText("Insert username *")
                ->setErrorField("You need to insert a username")
                ->setLabel("Username:"))
        ->append((new InputColumn((new TextInput("fname"))
                ->setRequired()
                ->setPlaceholder("First name"), ['small-12', 'large-4']))
                ->setLabel("First name:")
                ->setErrorField("You need to insert a username"))
        ->append((new InputColumn((new TextInput("lname"))
        ->setRequired()
        ->setPlaceholder("Family name"), ['small-12', 'large-4']))
        ->setErrorField("You need to insert a username")
        ->setLabel("Family name:"));
$form->append($row1);

$form->append(InputColumn::textarea("description", null, 5)
                ->setRequired()
                ->setPlaceholder("Something about yourself")
                ->setErrorField("Yuo need to write something about yourself"));
*/

use Sphp\Html\Foundation\Sites\Buttons\Button;
$form->append(Button::submitter("Submit form", "submit"));

$form->printHtml();
