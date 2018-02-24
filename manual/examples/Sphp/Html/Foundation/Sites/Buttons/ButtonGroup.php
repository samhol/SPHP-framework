<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$btns1 = new ButtonGroup();
$btns1->appendButton(new \Sphp\Html\Span("foo button"));
$btns1->appendButton(Button::hyperlink("http://www.google.com/", "google", "engine"));
$btns1->appendButton(Button::hyperlink("http://www.bing.com", "Bing", "engine"));
$btns1->appendHyperlink("https://www.yahoo.com/", "Yahoo!", "engine");
$btns1->setSize("tiny");

$btns2 = clone $btns1;
$btns2->setSize("small");

$btns3 = clone $btns2;
$btns3->setColor("success")
        ->setExtended(true);


echo "$btns1 $btns2 $btns3";
