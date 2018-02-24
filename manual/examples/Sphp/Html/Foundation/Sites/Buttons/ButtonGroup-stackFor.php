<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$buttonGroup = new ButtonGroup();
$buttonGroup->appendButton(Button::hyperlink("http://www.google.com/", "google", "engine"));
$buttonGroup->appendButton(Button::hyperlink("http://www.bing.com", "Bing", "engine"));
$buttonGroup->appendHyperlink("https://www.yahoo.com/", "Yahoo!", "engine");
$buttonGroup->stackFor("all")
        ->printHtml();
