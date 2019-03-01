<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm as GridForm;

$radioBoxes = [
    "m" => "male",
    "f" => "female",
    "x" => "X"
];
$checkBoxes = [
    "_basketball_" => "Basketball",
    "_football_" => "Football"
];
$checkboxes = (new Checkboxes("multiple", $checkBoxes, "Select hobbies:"))
        ->setOption("_volleyball_", "Volleyball");
$checkboxes->setLayouts('small-12', 'large-6');

$radios = (new Radioboxes("gender", $radioBoxes, "Select a gender:"))
        ->setOption("?", "unknown")
        ->setRequired();
$radios->setLayouts('small-12', 'large-6');
$form = new GridForm();
$form->append([$checkboxes, $radios]);
echo $form;
