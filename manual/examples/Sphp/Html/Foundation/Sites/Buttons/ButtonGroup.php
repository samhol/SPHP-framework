<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$btns1 = (new ButtonGroup())
        ->appendButtons(new \Sphp\Html\Span("foo button"))
        ->appendButtons(ButtonStyleAdapter::hyperlink("http://www.google.com/", "google", "engine"))
        ->appendButtons(ButtonStyleAdapter::hyperlink("http://www.bing.com", "Bing", "engine"))
        ->appendHyperlink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->setSize("tiny");

$btns2 = clone $btns1;
$btns2->setSize("small");

$btns3 = clone $btns2;
$btns3->setColor("success")
        ->setSize("expanded");


echo "$btns1 $btns2 $btns3";
