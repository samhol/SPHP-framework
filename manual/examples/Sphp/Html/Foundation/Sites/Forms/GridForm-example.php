<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputColumn;
use Sphp\Html\Foundation\Sites\Forms\Inputs\TextareaColumn;
use Sphp\Html\Forms\Inputs\Ion\RangeSlider;

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
        ->append(new \Sphp\Html\Forms\Inputs\HiddenInput("hidden_also", "another value"))
        ->append([
    (new InputColumn((new TextInput("username"))->setPlaceholder("Username"), 12, 12, 4))
    ->setLabel("Username:"),
    (new InputColumn((new TextInput("fname"))->setPlaceholder("First name"), 12, 6, 4))
    ->setLabel("First name:"),
    (new InputColumn((new TextInput("lname"))->setPlaceholder("Family name"), 12, 6, 4))
                ->setLabel("Family name:")]);

$form->append((new TextareaColumn("notes", "", 4))
                ->setPlaceholder("some notes about the person"));

$form->append(new Buttons\SubmitButton("Submit form", "submit"));

$form->printHtml();
?>
