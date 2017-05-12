<?php

namespace Sphp\Html\Foundation\Sites\Buttons;


$buttons[] = new HyperlinkButton("http://www.google.com/", "Google", "engine");
$buttons[] = new HyperlinkButton("http://www.bing.com", "Bing", "engine");
$buttons[] = new HyperlinkButton("http://www.ask.com/", "ask.com", "engine");

$buttonGroup = (new ButtonGroup($buttons))
        ->appendLink("https://www.yahoo.com/", "Yahoo!", "engine")
        ->stackFor("all");
$buttonGroup->printHtml();
?>