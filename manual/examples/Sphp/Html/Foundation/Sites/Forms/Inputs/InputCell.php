<?php

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$username = ValidableInlineInput::text('username');
$username->setRequired(true);
$username->setLeftInlineLabel('<i class="fa fa-user"></i>');
$username->setLabel('Username');
$username->setPlaceholder('Username');
$username->setErrorMessage('Username is required!');
$username->setRequired(true);

$fname = ValidableInlineInput::text('fname');
$fname->setRequired(true);
$fname->setLeftInlineLabel('<i class="fa fa-user"></i>');
$fname->setLabel('First name');
$fname->setPlaceholder('First name');
$fname->setErrorMessage('First name is required!');
$fname->setRequired(true);

$lname = ValidableInlineInput::text('lname');
$lname->setRequired(true);
$lname->setLeftInlineLabel('<i class="fa fa-user"></i>');
$lname->setLabel('Last name');
$lname->setPlaceholder('Last name');
$lname->setErrorMessage('Last name is required!');
$lname->setRequired(true);

$carSelector = ValidableInlineInput::select('Favourite car');
$carSelector->appendOption('', 'none');
$carSelector->appendOption('saab', 'Saab');
$carSelector->appendOption('volvo', 'Volvo');
$carSelector->appendOption('ferrari', 'Ferrari');
$carSelector->setErrorMessage('A car model is required');
$carSelector->setRequired(true);
$carSelector->setLeftInlineLabel('<i class="fas fa-car"></i>');


$carPrice = ValidableInlineInput::text('car_price');
$carPrice->setRequired(true);
$carPrice->setPattern('number');
$carPrice->setRightInlineLabel('<i class="fas fa-euro-sign"></i>');
$carPrice->setLabel('Suitable price');
$carPrice->setPlaceholder('10.000');
$carPrice->setErrorMessage('Car price is required and must be a decimal number!');
$carPrice->setRequired(true);

$form = new GridForm();
$form->useValidation(true);
$form->append($username);

$nameRow = new BasicRow();
$nameRow->appendCell($fname)->small(12)->medium(6);
$nameRow->appendCell($lname)->small(12)->medium(6);
$form->append($nameRow);


$carRow = new BasicRow();
$carRow->appendCell($carSelector)->small(12)->medium(6);
$carRow->appendCell($carPrice)->small(12)->medium(6);
$form->append($carRow);

$form->appendHiddenVariable('hidden1', 'I am hidden!');

$buttonRow = new BasicRow();
$buttons = new ButtonGroup();
$buttons->appendSubmitter('Submit')->addCssClass('success');
$buttons->appendResetter('Reset form')->addCssClass('alert');
$buttons->setExtended();
$buttonRow->appendCell($buttons);
$form->append($buttonRow);
$form->liveValidate();
echo $form;
