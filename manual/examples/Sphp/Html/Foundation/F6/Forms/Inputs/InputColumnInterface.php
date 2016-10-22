<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm as GridForm;
use Sphp\Html\Foundation\Sites\Forms\FormRow as FormRow;

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
        ->setTarget("outputFrame");
$row1 = (new FormRow())
        ->append((new TextColumn("username"))
                ->setRequired()
                ->setHelperText("Insert username *")
                ->setErrorField("You need to insert a username")
                ->setPlaceholder("Username")
                ->setLabel("Username:")
                ->setWidths(12, 4, 4))
        ->append((new TextColumn("fname"))
                ->setRequired()
                ->setPlaceholder("First name")
                ->setWidths(12, 4, 4)
                ->setLabel("First name:"))
        ->append((new TextColumn("lname"))
                ->setRequired()
                ->setPlaceholder("Family name")
                ->setWidths(12, 4, 4)
                ->setLabel("Family name:"));
$form->append($row1)
        ->append([
            (new SelectMenuColumn("select", $cars))
            ->selectMultiple()
            ->setRequired()
            ->setHelperText("Select atleast one car")
            ->setErrorField("Yuo need to select atleast one car")
            ->setLabel("Select your favourite cars")
            ->setWidths(12, 6)]);
$form->append((new \Sphp\Html\Forms\Inputs\Ion\RangeSlider("range", -10, 20, 1))
        ->setValue([-50, 50])
        ->setPostfix("&deg;C"));
$form->append((new TextareaColumn("description", null, 4))
                ->setRequired()
                ->setPlaceholder("Something about yourself")
                ->setErrorField("Yuo need to write something about yourself"));

namespace Sphp\Html\Foundation\Sites\Forms\Buttons;

$form->append(new SubmitButton("Submit form", "submit"));

$form->printHtml();
?>
