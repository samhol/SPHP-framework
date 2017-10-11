<?php

namespace Sphp\Html\Forms\Buttons;

(new Submitter('Submit Form', 'submitter', 'submit'))
        ->addCssClass('success', 'button')
        ->printHtml();
(new Resetter('Reset form values'))
        ->addCssClass('alert', 'button')
        ->printHtml();
(new Button('Push button'))
        ->addCssClass('button')
        ->printHtml();
