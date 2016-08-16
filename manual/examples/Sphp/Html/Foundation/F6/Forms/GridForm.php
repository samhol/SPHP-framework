<?php

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\Forms\Inputs\TextInput as TextInput;
use Sphp\Html\Forms\Inputs\Textarea as Textarea;
use Sphp\Html\Foundation\F6\Forms\Inputs\InputColumn as InputColumn;
use Sphp\Html\Foundation\F6\Forms\Inputs\TextColumn as TextColumn;
use Sphp\Html\Foundation\F6\Forms\Inputs\SelectMenuColumn as SelectMenuColumn;

$cars = ["Sweden" => [
        "saab" => "Saab",
        "volvo" => "Volvo"
    ],
    "Germany" => [
        "audi" => "Audi",
        "bmw" => "BMW",
        "mb" => "Mercedes-Benz",
        "opel" => "Opel",
        "porsche" => "Porsche",
        "vw" => "Volkswagen"
    ],
    "Italy" => [
        "ferrari" => "Ferrari",
        "fiat" => "Fiat"
    ]
];
$form = (new GridForm())
        ->validation(true)
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
    (new TextColumn("textColumn1"))
        ->setRequired()
        ->setHelperText("insert any text *")
        ->setErrorField("Fill this up")
        ->setPlaceholder("textColumn 1.")
        ->setWidths(12, 6), 
    (new TextColumn("textColumn2"))
        ->setPlaceholder("textColumn 2.")
        ->setWidths(12, 6), 
    (new SelectMenuColumn("select", $cars))
        ->selectMultiple()
        ->setRequired()
        ->setHelperText("Select atleast one car")
        ->setErrorField("Yuo need to select atleast one car")
        ->setWidths(12, 6)]);
$form->append((new Textarea("notes", "", 4))
                ->setPlaceholder("some notes about the person"));
$form->append(new Buttons\SubmitButton("Submit form", "submit"));

$form->printHtml();
?>
