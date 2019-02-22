<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

$pages = array_fill(1, 99, 'javascript:void();');

for ($i = 1; $i <= 50; $i++) {
  //$pages[$i] = "#id_$i";
}

$slice = array_slice($pages, 5, 10, true);
print_r($slice);
$pagination = new Pagination();
foreach ($slice as $index => $url) {
  $pagination->setPage($index, $url);
}

$pagination->printHtml();
