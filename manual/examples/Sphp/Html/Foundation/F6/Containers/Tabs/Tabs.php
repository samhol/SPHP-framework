<?php

namespace Sphp\Html\Foundation\F6\Containers\Tabs;

use Sphp\Core\Router;

$tabs = (new Tabs())->matchHeight(true);
$tabs->appendTab("1st. tab")->appendMdFile(Router::get()
        ->local("manual/snippets/loremipsum.md"));
$tabs->appendTab("2nd. Tab", "The content of the second tab");
$tabs->appendTab("3rd. Tab");
$tabs->appendTab("4th. Tab", "The content of the fourth tab");

$tabs->activate(1)
        ->getTab(2)
        ->appendRawFile(Router::get()->local("manual/snippets/loremipsum.html"));
$tabs->printHtml();
?>
