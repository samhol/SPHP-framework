<?php

namespace Sphp\Html\Foundation\F6\Forms\Inputs;

use Sphp\Html\Foundation\F6\Forms\GridForm as GridForm;
use Sphp\Html\Forms\Inputs\Textarea as Textarea;
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
        ->append([
    (new TextColumn("username"))
    ->setRequired()
    ->setHelperText("Inser username *")
    ->setErrorField("You need to insert a username")
    ->setPlaceholder("Username")
    ->setWidths(12, 4, 4)
    ->setLabel("Username:"),
    (new TextColumn("fname"))
    ->setRequired()
    ->setPlaceholder("First name")
    ->setWidths(12, 4, 4)
    ->setLabel("First name:"),
    (new TextColumn("lname"))
    ->setRequired()
    ->setPlaceholder("Family name")
    ->setWidths(12, 4, 4)
    ->setLabel("Family name:")]);
$form->append([
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
