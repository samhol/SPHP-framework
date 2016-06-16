<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\Menus\MenuFactory as MenuFactory;
use Sphp\Html\Forms\Input\TextInput as TextInput;
use Sphp\Html\Forms\Radioboxes as Radioboxes;
use Sphp\Html\Forms\Checkboxes as Checkboxes;
use Sphp\Html\Forms\Textarea as Textarea;

$form = (new GridForm())
        ->setTarget("outputFrame")
        ->appendHiddenVariable("hidden", "value")
        ->append([
    (new InputColumn((new TextInput("username"))->setPlaceholder("Username"), 12, 4, 4))
    ->setLabel("Username:"),
    (new InputColumn((new TextInput("fname"))->setPlaceholder("First name"), 12, 4, 4))
    ->setLabel("First name:"),
    (new InputColumn((new TextInput("lname"))->setPlaceholder("Family name"), 12, 4, 4))->setLabel("Family name:")]);

$form->append((new Textarea("notes", "", 4))
                ->setPlaceholder("some notes about the person"));

$form->printHtml();
?>
