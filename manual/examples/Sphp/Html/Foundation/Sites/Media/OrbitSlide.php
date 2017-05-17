<?php

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

$orbit = new Orbit();
$captionSuffix = "Image Placeholder <small>original size: 750x250</small>";
$orbit->appendFigure("http://placehold.it/750x250/f00/fff", "Red $captionSuffix")
        ->appendFigure("http://placehold.it/750x250/000/fff", "Black $captionSuffix")
        ->appendFigure("http://placehold.it/750x250/ccc/fff", "Gray $captionSuffix")
        ->appendFigure("http://placehold.it/750x250/0f0/fff", "Green $captionSuffix")
        ->appendFigure("http://placehold.it/750x250/00f/fff", "Blue $captionSuffix")
        ->appendFigure("http://placehold.it/750x250/0ff/fff", "Cyan $captionSuffix")
        ->appendFigure("http://placehold.it/750x250/f0f/fff", "Magenta $captionSuffix")
        ->appendFigure("http://placehold.it/750x250/ff0/000", "Yellow $captionSuffix")
        ->appendFigure("http://placehold.it/750x250/fff/000", "White $captionSuffix")
        ->printHtml();
