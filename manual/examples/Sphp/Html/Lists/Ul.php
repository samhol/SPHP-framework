<?php

namespace Sphp\Html\Lists;

use Sphp\Html\Foundation\Sites\Grids\Row;

$a_i = range('a', 'i');
$ul = new Ul($a_i);
$ul1 = new Ul(range('b', 'i'));
$ul1->prepend("a");
$ul2 = new Ul();
$ul2->append("Second");
$ul2->prepend("First");
$ul2->appendLink("http://www.w3schools.com/html/html_lists.asp", "w3schools", "_blank");
$ul3 = clone $ul2;
$ol = (new Ol($a_i))
        ->setListType("I");
$ol1 = (new Ol($a_i))
        ->setStart(5)
        ->setReversed(TRUE);

(new Row([$ul, $ul1, $ul2, $ul3, $ol, $ol1]))->printHtml();
