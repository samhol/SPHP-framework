<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Foundation\Sites\Buttons\Button;
use Sphp\Html\Forms\Inputs\AnyTimeInput;

$section = new \Sphp\Html\Flow\Section();
$section->appendH1('Calendar task form');
$form = (new GridForm())
        ->useValidation(true);
$usernameField = (new TextInput("username"))->setPlaceholder("Username");
$row = new FormRow();

$datetimeInput = (new AnyTimeInput('start'))->setLocale('fi_FI');
$endInput = (new AnyTimeInput('end'))->setLocale('fi_FI');
$types = ['Basketball', 'Work', 'School'];
$yearMenu = \Sphp\Html\Forms\Inputs\Menus\Select::from('year', $types);
$row->append((new BasicInputCell($yearMenu
                        ->setRequired(), ['small-12', 'large-4']))
                ->setErrorField("You need to insert a task type")
                ->setLabel("Task type:"));
$row->append((new BasicInputCell($datetimeInput
                        ->setPlaceholder('yyyy-mm-dd hh:mm')
                        ->setRequired(), ['small-12', 'large-4']))
                ->setErrorField("You need to give start time")
                ->setLabel("Start time:"));
$row->append((new BasicInputCell($endInput
                        ->setPlaceholder('yyyy-mm-dd hh:mm')
                        ->setRequired(), ['small-12', 'large-4']))
                ->setErrorField("You need to give end time")
                ->setLabel("Stop time:"));

$form->append($row);

$form->append(BasicInputCell::textarea("description", null, 5)
                ->setRequired()
                ->setInputPlaceholder("Description of the calendar task")
                ->setErrorField("Please insert task description"));

$form->append(Button::submitter("Submit form", "submit"));
$section->append($form);
$section->printHtml();

if (!empty($_GET)) {
  echo '<h1>$_POST</h1><pre>';
  var_dump($_GET);
  echo '</pre>';
}