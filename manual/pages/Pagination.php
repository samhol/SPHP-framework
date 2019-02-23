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
$pagination->setPrevious("javascript:alert('previous');");
$pagination->setNext("javascript:alert('next');");
$pagination->printHtml();

$pagination1 = new Pagination();
$letters = \Sphp\Stdlib\Strings::toArray('foobar');
print_r($letters);
foreach ($letters as $index => $letter) {
  $pagination1->setPage($index+6, "javascript:alert('" . $letter . "');", $letter);
}
$pagination1->insertPage(new Page("javascript:alert('is');", 'is'));

$pagination1->printHtml();
