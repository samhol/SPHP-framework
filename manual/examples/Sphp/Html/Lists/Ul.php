<?php

namespace Sphp\Html\Lists;

use Sphp\Html\Foundation\Sites\Grids\Row;

$a_i = range('a', 'i');
$ul = new Ul($a_i);
$ul1 = (new Ul(range('b', 'i')))
        ->prepend("a");
$ul1[1] = "b reviseted";
$ul2 = (new Ul())
        ->append("Second")
        ->prepend("First")
        ->appendLink("http://www.w3schools.com/html/html_lists.asp", "w3schools", "_blank");
$ul2[] = new Li("Fourth");
$ul3 = clone $ul2;
$ul3[] = clone $ul1;
$ol = (new Ol($a_i))
        ->setType("I");
$ol1 = (new Ol($a_i))
        ->setStart(5)
        ->setReversed(TRUE);

(new Row([$ul, $ul1, $ul2, $ul3, $ol, $ol1]))->printHtml();

?>
