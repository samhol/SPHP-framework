<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Stdlib\URL;

$currentUrl = URL::getCurrent()->getHtml();
$pages = [];
$pages[] = $currentUrl;
for ($i = 2; $i <= 50; $i++) {
  $pages[] = "$currentUrl#num$i";
}
$pages[8] = $currentUrl;
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
