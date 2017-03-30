<?php

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Stdlib\Path;

$tabs = (new Tabs());
$tabs->appendTab("1st. tab")->appendMdFile("manual/snippets/loremipsum.md");
$tabs->appendTab("2nd. Tab", "The content of the second tab");
$tabs->appendTab("3rd. Tab");
$tabs->appendTab("4th. Tab", "The content of the fourth tab");

$tabs->getTab(2)
        ->appendRawFile(Path::get()->local("manual/snippets/loremipsum.html"));
$tabs->printHtml();
?>
