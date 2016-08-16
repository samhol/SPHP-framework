<?php

namespace Sphp\Html\Foundation\F6\Forms;

$form = (new GridForm())
        ->validation(true)
        ->setTarget("outputFrame")
        ->append(new Buttons\FileUploadButton("img-file", "Select image"))
        ->append(new Buttons\SubmitButton("Load Image", "submit"));

$form->printHtml();
?>
