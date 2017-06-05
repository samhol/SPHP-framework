<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$buttonGroup = (new ButtonGroup())
        ->appendLink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->appendLink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->setColor("success");
$buttonGroup->printHtml();
