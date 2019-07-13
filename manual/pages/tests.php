<?php
$cookieBanner = new Sphp\Html\Apps\CookieBanner();
echo $cookieBanner;

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

$pwField = ValidableInlineInput::password('password');
$pwField->setRequired(true);
$pwField->setLeftInlineLabel('<i class="fas fa-key"></i>');
$pwField->setLabel('Password');
$pwField->setPlaceholder('Password');
$pwField->setErrorMessage('Password is required!');
$pwField->setRequired(true);


$form = new GridForm();
$form->liveValidate(true);

$nameRow = new BasicRow();
$nameRow->appendCell($username)->small(12);
$form->append($nameRow);

$pwRow = new BasicRow();
$pwRow->appendCell($pwField)->small(12);
$form->append($pwRow);




$form->appendHiddenVariable('hidden1', 'I am hidden!');

$buttonRow = new BasicRow();
$buttons = new ButtonGroup();
$buttons->appendSubmitter('Submit')->addCssClass('success');
$buttons->setExtended();
$buttonRow->appendCell($buttons);
$form->append($buttonRow);
$form->liveValidate();
echo $form;
?>