<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

$pages = array_fill(1, 99, 'javascript:void();');


$slice = array_slice($pages, 5, 10, true);
print_r($slice);
$pagination = new Pagination();
foreach ($slice as $index => $url) {
  $pagination->setPage($index, $url);
}
$pagination->setPage(45, $url);
$pagination->getPage(7)->setCurrent(true);
$pagination->getPage(8)->disable(true);
$pagination->setPreviousPageButton("javascript:alert('previous');");
$pagination->setNextPageButton("javascript:alert('next');");
$pagination->printHtml();
