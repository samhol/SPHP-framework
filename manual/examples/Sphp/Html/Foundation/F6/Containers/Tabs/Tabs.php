<?php

namespace Sphp\Html\Foundation\Sites\Containers\Tabs;

use Sphp\Core\Path;

$tabs = (new Tabs())->matchHeight(true);
$tabs->appendTab("1st. tab")->appendMdFile(Path::get()
        ->local("manual/snippets/loremipsum.md"));
$tabs->appendTab("2nd. Tab", "The content of the second tab");
$tabs->appendTab("3rd. Tab");
$tabs->appendTab("4th. Tab", "The content of the fourth tab");

$tabs->setActive(1)
        ->getTab(2)
        ->appendRawFile(Path::get()->local("manual/snippets/loremipsum.html"));
$tabs->printHtml();
?>
