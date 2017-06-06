<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$btns1 = (new ButtonGroup())
        ->appendButton(Button::hyperlink("http://www.google.com/", "google", "engine"))
        ->appendButton(Button::hyperlink("http://www.bing.com", "Bing", "engine"))
        ->appendLink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->setSize("tiny");

$btns2 = clone $btns1;
$btns2->setSize("small");

$btns3 = clone $btns2;
$btns3->setColor("success")
        ->setSize("expanded ");


echo "$btns1 $btns2 $btns3";
