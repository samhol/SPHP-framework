<?php

namespace Sphp\Html\Lists;

use Sphp\Html\Foundation\Sites\Grids\BasicRow;

$colors = ['red', 'green', 'blue', 'white'];
$ol = new Ol($colors);
$ol->appendLink('http://www.w3schools.com/colors/color_tryit.asp?color=Black', 'black', '_blank');
$ol->append("magenta");
$ol->prepend("purple");

$olCopy = clone $ol;
$olCopy->setListType('I');

(new BasicRow([$ol, $olCopy]))->printHtml();
