<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\Inputs\TextInput as TextInput;
use Sphp\Html\Forms\Radioboxes as Radioboxes;
use Sphp\Html\Forms\Checkboxes as Checkboxes;
use Sphp\Html\Forms\Textarea as Textarea;
use Sphp\Html\Foundation\F6\Forms\Inputs\InputColumn as InputColumn;
use Sphp\Html\Foundation\F6\Forms\Inputs\TextColumn as TextColumn;

$form = (new GridForm())
        ->setTarget("outputFrame")
        ->appendHiddenVariable("hidden", "value")
        ->append([
    (new InputColumn((new TextInput("username"))->setPlaceholder("Username"), 12, 4, 4))
    ->setLabel("Username:"),
    (new InputColumn((new TextInput("fname"))->setPlaceholder("First name"), 12, 4, 4))
    ->setLabel("First name:"),
    (new InputColumn((new TextInput("lname"))->setPlaceholder("Family name"), 12, 4, 4))
                ->setLabel("Family name:")]);
$form->append([
    (new TextColumn("textColumn1"))->setRequired()->setErrorField("Fill this up")->setPlaceholder("textColumn 1.")->setWidths(12, 6), 
    (new TextColumn("textColumn2"))->setPlaceholder("textColumn 2.")->setWidths(12, 6)]);
$form->append((new Textarea("notes", "", 4))
                ->setPlaceholder("some notes about the person"));
$form->append(new Buttons\SubmitButton("Submit form", "submit"));

$form->printHtml();
?>
