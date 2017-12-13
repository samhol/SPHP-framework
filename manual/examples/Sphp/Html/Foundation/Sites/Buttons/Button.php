<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$b1 = ButtonStyleAdapter::hyperlink("http://www.google.com/", "Google", "engine")
        ->setSize("small")
        ->setColor("alert");
$b2 = ButtonStyleAdapter::hyperlink("http://www.bing.com", "Bing", "engine")
        ->setSize("medium")
        ->setColor("warning")
        ->disable(true);
$b3 = ButtonStyleAdapter::hyperlink("http://www.ask.com/", "ask.com", "engine")
        ->setSize("large")
        ->setColor("success")
        ->isHollow(true);
$b4 = ButtonStyleAdapter::submitter("Submit!", "submit", "foo")
        ->setColor("secondary")
        ->isDropdown(true);

echo "$b1 $b2 $b3 $b4";
