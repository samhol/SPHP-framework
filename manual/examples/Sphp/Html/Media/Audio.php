<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;

$audio = (new Audio("https://upload.wikimedia.org/wikipedia/commons/0/0a/Pl-Bytom.ogg"))
        ->showControls(true);

$audio1 = (new Audio("https://upload.wikimedia.org/wikipedia/en/2/26/Europe_-_The_Final_Countdown.ogg"))
        ->showControls(true);

(new BlockGrid())
        ->setBlockGrid(2, "small")
        ->append($audio)
        ->append($audio1)
        ->printHtml();
?>
