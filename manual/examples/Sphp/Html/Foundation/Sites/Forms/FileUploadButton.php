<?php

namespace Sphp\Html\Foundation\Sites\Forms;
use Sphp\Html\Foundation\Sites\Buttons\Button;

$form = (new GridForm())
        ->validation(true)
        ->setTarget("outputFrame")
        ->append(new Buttons\FileUploadButton("img-file", "Select image"))
        ->append(Button::submitter("Load Image", "submit"));

$form->printHtml();
