<?php

namespace Sphp\Html\Foundation\Sites\Forms;
use Sphp\Html\Foundation\Sites\Buttons\ButtonStyleAdapter;
use Sphp\Html\Foundation\Sites\Buttons\FileUploadButton;

$form = (new GridForm())
        ->validation(true)
        ->setTarget("outputFrame")
        ->append(new FileUploadButton("img-file", "Select image"))
        ->append(ButtonStyleAdapter::submitter("Load Image", "submit"));

$form->printHtml();
