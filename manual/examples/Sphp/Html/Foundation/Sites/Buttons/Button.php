<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

Button::hyperlink("http://www.google.com/", "Google", "engine")
        ->setSize("large")
        ->setColor("alert")
        ->printHtml();
Button::hyperlink("http://www.bing.com", "Bing", "engine")
        ->setSize("large")
        ->setColor("warning")
        ->printHtml();
Button::hyperlink("http://www.ask.com/", "ask.com", "engine")
        ->setSize("large")
        ->setColor("success")
        ->printHtml();
Button::submitter("Submit!", "submit", "foo")
        ->setSize("medium")
        ->setColor("secondary")
        ->printHtml();

