<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\Radioboxes as Radioboxes;
use Sphp\Html\Forms\Inputs\Checkboxes as Checkboxes;

$radioBoxes = (new Radioboxes("gender", [
    "m" => "male",
    "f" => "female",
    "x" => "X",
    "?" => "unknown"], "Gender"));
$checkBoxes = (new Checkboxes("hobbies", [
    "bball" => "Basketball",
    "football" => "Football",
    "cycling" => "Cycling",
    "running" => "Running",
    "swimming" => "Swimming",
    "lifting" => "Weightlifting"
        ], "Hobbies", true));

$form = new Form();

$form[] = $radioBoxes;
$form[] = $checkBoxes;

$form->printHtml();

?>
