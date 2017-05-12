<?php


namespace Sphp\Html\Foundation\Sites\Forms\Inputs;

use Sphp\Html\Foundation\Sites\Forms\GridForm as GridForm;

$fooData = [
    "a" => "Letter a",
    "b" => "Letter b",
    "c" => "Letter c"];
$checkboxes = (new Checkboxes("multiple", $fooData, "Select letters:"))
        ->setOption("d", "Letter d")
        ->setWidths(12, false, 6);

$radios = (new Radioboxes("single", $fooData, "Select a letter:"))
        ->setOption("d", "Letter d")
        ->setRequired()
        ->setWidths(12, false, 6);
$form = new GridForm();
$form->append([$checkboxes, $radios]);
echo $form;
?>