<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$b1 = Button::hyperlink("http://www.google.com/", "Google", "engine")
        ->setSize("small")
        ->setColor("alert");
$b2 = Button::hyperlink("http://www.bing.com", "Bing", "engine")
        ->setSize("medium")
        ->setColor("warning")
        ->disable(true);
$b3 = Button::hyperlink("http://www.ask.com/", "ask.com", "engine")
        ->setSize("large")
        ->setColor("success")
        ->isHollow(true);
$b4 = Button::submitter("Submit!", "submit", "foo")
        ->setColor("secondary")
        ->isDropdown(true);

echo "$b1 $b2 $b3 $b4";
