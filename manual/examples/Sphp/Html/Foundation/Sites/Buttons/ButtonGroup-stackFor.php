<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$buttonGroup = (new ButtonGroup())
        ->appendButtons(Button::hyperlink("http://www.google.com/", "google", "engine"))
        ->appendButtons(Button::hyperlink("http://www.bing.com", "Bing", "engine"))
        ->appendHyperlink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->stackFor("all")
        ->printHtml();
