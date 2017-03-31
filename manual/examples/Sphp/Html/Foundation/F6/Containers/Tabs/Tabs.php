<?php

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

$tabs = (new Tabs());
$tabs->appendTab("1st. tab")->appendMdFile("manual/snippets/loremipsum.md");
$tabs->appendTab("2nd. Tab", "The content of the second tab");
$tabs->appendTab("3rd. Tab");
$tabs->appendTab("4th. Tab", "The content of the fourth tab");

$tabs->getTab(2)
        ->appendRawFile("manual/snippets/loremipsum.html");
$tabs->printHtml();
?>
