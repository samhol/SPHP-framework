<?php

namespace Sphp\Html\Lists;

use Sphp\Html\Foundation\Sites\Grids\Row;

$colors = ['red', 'green', 'blue', 'white'];
$ol = (new Ol($colors))
        ->appendLink('http://www.w3schools.com/colors/color_tryit.asp?color=Black', 'black', '_blank')
        ->append("magenta")
        ->prepend("purple");

$olCopy = clone $ol;
$olCopy->setType('I');

(new Row([$ol, $olCopy]))->printHtml();
?>