<?php

namespace Sphp\Html\Foundation\F6\Containers;

$panel1 = (new Callout("First Callout"))
        ->ajaxAppend("manual/snippets/loremipsum.html #par_2")
        ->setColor("success")
        ->setClosable()
        ->printHtml();
$panel2 = (new Callout("Second Callout"))
        ->append($panel1->setColor("warning"))
        ->setColor("alert")
        ->setClosable()
        ->printHtml();
$panel3 = (new Callout("Second Callout"))
        ->ajaxAppend("manual/snippets/loremipsum.html #par_1")
        ->setColor("warning")
        ->setClosable()
        ->printHtml();
?>
