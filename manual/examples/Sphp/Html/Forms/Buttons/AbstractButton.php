<?php

namespace Sphp\Html\Forms\Buttons;

(new Submitter("button:submit", "submitter", "submit"))
        ->addCssClass("success", "button")
        ->printHtml();
(new Resetter("button:reset"))
        ->addCssClass("alert", "button")
        ->printHtml();
(new Button("button:push"))
        ->addCssClass("button")
        ->printHtml();

namespace Sphp\Html\Forms\Inputs\Buttons;

(new Submitter("input:submit", "submitter", "submit"))
        ->addCssClass("success", "button")
        ->printHtml();
(new Resetter("input:reset"))
        ->addCssClass("alert", "button")
        ->printHtml();
(new Button("input:push"))
        ->addCssClass("button")
        ->printHtml();
