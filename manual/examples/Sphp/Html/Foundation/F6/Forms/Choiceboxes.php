<?php

namespace Sphp\Html\Foundation\F6\Forms;

$fooData = [
    "foo" => "Foo",
    "bar" => "Bar",
    "foobar" => "Bar of Foos"];
$checkboxes = (new Checkboxes("checkboxes", $fooData, "Check boxes:"))
        ->setOption("double foo", "Double Foo")
        ->setWidths(12, false, 6);

$radios = (new Radioboxes("radios", $fooData, "Select a radio:"))
        ->setOption("double foo", "Double Foo")
        ->setRequired()
        ->setWidths(12, false, 6);
$form = new GridForm();
$form->append([$checkboxes, $radios]);
echo $form;
?>
