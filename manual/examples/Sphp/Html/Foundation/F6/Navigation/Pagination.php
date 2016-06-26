<?php

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

use Sphp\Core\Configuration as Configuration;

$currentUrl = Configuration::httpHost();
$pages = [];
for ($i = 1; $i <= 50; $i++) {
  $pages[] = "$currentUrl#num$i";
}

$pagination = (new Pagination($pages));
$pagination->printHtml();

$pagination->setRange(10)->setCurrent(12);

$pagination->printHtml();
$pagination->setCurrent(50);

$pagination->printHtml();
$pages2 = array_slice($pages, 0, 10);

$pagination2 = (new Pagination($pages2));
$pagination2->printHtml();
?>