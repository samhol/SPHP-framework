<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$buttonGroup = (new ButtonGroup())
        ->appendButton(Button::hyperlink("http://www.bing.com", "Bing", "engine"))
        ->appendHyperlink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->setColor("success");
$buttonGroup->printHtml();
