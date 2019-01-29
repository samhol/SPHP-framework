<?php

namespace Sphp\Html\Foundation\Sites\Containers\Accordions;

$pane = new ContentPane("First Accordion");
$pane->ajaxAppend("manual/snippets/loremipsum.html #par_3");
$accordion = (new Accordion())
        ->append($pane)
        ->append(new ContentPane("Second Accordion", "Nothing intresting here"))
        ->allowMultiExpand()
        ->allowAllClosed()
        ->printHtml();
?>
