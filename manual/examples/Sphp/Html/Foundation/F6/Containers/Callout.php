<?php

namespace Sphp\Html\Foundation\Sites\Containers;

$panel1 = (new Callout())
        ->appendMd("####First Callout")
        ->ajaxAppend("manual/snippets/loremipsum.html #par_2")
        ->setColor("success")
        ->setClosable();
$panel2 = (new Callout())
        ->appendMd("####Second Callout")
        ->append($panel1)
        ->setColor("alert")
        ->printHtml();
$panel3 = (new Callout("<h4>Persistent callout</h4>"))
        ->ajaxAppend("manual/snippets/loremipsum.html #par_1")
        ->setColor("warning")
        ->setClosable(false)
        ->printHtml();
?>
