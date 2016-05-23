<?php

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Input\TextInput as TextInput;
use Sphp\Html\Forms\Input\DateTimeInput as DateTimeInput;
use Sphp\Html\Forms\Radioboxes as Radioboxes;
use Sphp\Html\Forms\Checkboxes as Checkboxes;
use Sphp\Html\Forms\Textarea as Textarea;

//use Sphp\Html\Forms\Textarea as Textarea;

$usernameInput = (new TextInput("username"))
        ->setMaxlength(10)
        ->setSize(10)
        ->setRequired()
        ->setPlaceholder("Username")
        ->setLabel("Username:");
$datetimeInput = (new DateTimeInput("datetime"))
        ->setPlaceholder("what ever time...")
        ->setLabel("What ever time...");

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

$form = (new Form("sphpManual/pages/formSubmit.php", "post"));

$form[] = $usernameInput;
$form[] = $datetimeInput;
$form[] = $radioBoxes;

$form[] = $checkBoxes;

$form[] = (new Textarea("textarea", "", 4))
        ->setPlaceholder("&lt;textarea&gt;")
        ->setLabel("Notes:");

$form->printHtml();
?>