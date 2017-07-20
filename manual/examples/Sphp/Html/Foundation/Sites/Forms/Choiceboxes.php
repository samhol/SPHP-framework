<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm as GridForm;

$radioBoxes = [
    "m" => "male",
    "f" => "female",
    "x" => "X"
];
$checkBoxes = [
    "bball" => "Basketball",
    "football" => "Football",
    "cycling" => "Cycling",
    "running" => "Running",
    "swimming" => "Swimming"
];
$checkboxes = (new Checkboxes("multiple", $checkBoxes, "Select hobbies:"))
        ->setOption("lifting", "Weightlifting");
$checkboxes->layout()->setLayouts(['small-12', 'large-6']);

$radios = (new Radioboxes("gender", $radioBoxes, "Select a gender:"))
        ->setOption("?", "unknown")
        ->setRequired();
$radios->layout()->setLayouts(['small-12', 'large-6']);
$form = new GridForm();
$form->append([$checkboxes, $radios]);
echo $form;
