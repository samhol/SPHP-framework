<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Forms\Inputs\Buttons\Submitter;
use Sphp\Html\Foundation\Sites\Forms\FormRow;

$row = new FormRow();

$ruleMenu = (new Select('rule'));
$ruleMenu->appendOption('starts', 'Starts with:');
$ruleMenu->appendOption('contains', 'Contains:', TRUE);
$ruleMenu->appendOption('ends', 'Ends with:');
//->setLabel('Search rule:');
$row->appendInput($ruleMenu)->shrink();
$searchInput = (new TextInput('search'))
        ->setSize(30)
        ->setRequired()
        ->setPlaceholder('Search for messages containing text');
//->setLabel('A part of Message:');

$row->appendInput($searchInput)->auto();
$perPageOptions = [];
for ($i = 10; $i <= 50; $i += 10) {
  $perPageOptions[$i] = "Show $i results per page";
}

$perPage = new Select('view', $perPageOptions);
$row->appendInput($perPage)->shrink();
$row->appendInput(new Submitter('Submit', 'submit', 'submitted'))->shrink();

$form = new ContainerForm('/gettext', 'get');
$form->appendHiddenVariable('page', 1);
echo 'Search';
$form->append($row)->printHtml();


