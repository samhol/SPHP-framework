<?php

namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm as GridForm;

$fooData = [
    "a" => "Letter a",
    "b" => "Letter b",
    "c" => "Letter c"];
$checkboxes = (new Checkboxes("multiple", $fooData, "Select letters:"))
        ->setOption("d", "Letter d");
$checkboxes->layout()->setLayouts(['small-12', 'large-6']);

$radios = (new Radioboxes("single", $fooData, "Select a letter:"))
        ->setOption("d", "Letter d")
        ->setRequired();
$radios->layout()->setLayouts(['small-12', 'large-6']);
$form = new GridForm();
$form->append([$checkboxes, $radios]);
echo $form;
?>
