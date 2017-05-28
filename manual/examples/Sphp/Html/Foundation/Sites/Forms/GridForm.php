<?php

namespace Sphp\Html\Foundation\Sites\Forms;

use Sphp\Html\Forms\Inputs\TextInput;
use Sphp\Html\Forms\Inputs\Textarea;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputColumn;

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
    (new InputColumn((new TextInput("username"))->setPlaceholder("Username"), ['small-12', 'medium-12', 'large-4']))
    ->setLabel("Username:"),
    (new InputColumn((new TextInput("fname"))->setPlaceholder("First name"), ['small-12', 'medium-6', 'large-4']))
    ->setLabel("First name:"),
    (new InputColumn((new TextInput("lname"))->setPlaceholder("Family name"), ['small-12', 'medium-6', 'large-4']))
                ->setLabel("Family name:")]);

$form->append((new Textarea("notes", "", 4))
                ->setPlaceholder("some notes about the person"));
$form->append(new Buttons\SubmitButton("Submit form", "submit"));

$form->printHtml();
?>
