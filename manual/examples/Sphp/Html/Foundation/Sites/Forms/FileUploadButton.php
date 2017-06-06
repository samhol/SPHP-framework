<?php

namespace Sphp\Html\Foundation\Sites\Forms;
use Sphp\Html\Foundation\Sites\Buttons\Button;
use Sphp\Html\Foundation\Sites\Buttons\FileUploadButton;

$form = (new GridForm())
        ->validation(true)
        ->setTarget("outputFrame")
        ->append(new FileUploadButton("img-file", "Select image"))
        ->append(Button::submitter("Load Image", "submit"));

$form->printHtml();
