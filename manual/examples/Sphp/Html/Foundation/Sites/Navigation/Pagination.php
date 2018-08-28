<?php

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

for ($i = 1; $i <= 50; $i++) {
  $pages[$i] = "#id_$i";
}
$pagination = new Pagination();
$pagination->setPages($pages)
        ->visibleAfterCurrent(10)
        ->visibleBeforeCurrent(5)
        ->setCurrentPage(10)
        ->printHtml();
