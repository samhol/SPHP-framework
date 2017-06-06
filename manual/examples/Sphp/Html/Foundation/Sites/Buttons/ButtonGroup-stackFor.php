<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$buttonGroup = (new ButtonGroup($buttons))
        ->appendButton(Button::hyperlink("http://www.google.com/", "google", "engine"))
        ->appendButton(Button::hyperlink("http://www.bing.com", "Bing", "engine"))
        ->appendLink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->stackFor("all")
        ->printHtml();
