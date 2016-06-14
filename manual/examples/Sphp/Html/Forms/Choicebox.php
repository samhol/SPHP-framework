<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Radioboxes as Radioboxes;
use Sphp\Html\Forms\Checkboxes as Checkboxes;
use Sphp\Html\Forms\Textarea as Textarea;
use Sphp\Html\Forms\Input\Radiobox as Radiobox;

$radios[] = new Radiobox("radio[]", "a");
$radios[] = new Radiobox("radio[]", "b");
$radios[] = new Radiobox("radio[]", "c");
$radios[] = new Radiobox("radio[]", "d");

$radioBoxes = (new Radioboxes("gender", [
    "m" => "male",
    "f" => "female",
    "?" => "unknown"], "Gender"))
        ->disable();
$checkBoxes = (new Checkboxes("hobbies", [
    "bball" => "Basketball",
    "football" => "Football",
    "cycling" => "Cycling",
    "running" => "Running",
    "swimming" => "Swimming",
    "lifting" => "Weightlifting"
        ], "Hobbies", true));

$form = (new Form())->append($radios);

$form[] = $radioBoxes;

$form[] = $checkBoxes;

$form->printHtml();
?>