<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\Sites\Grids\Grid as Grid;

$inlineStyles = [
    'overflow' => 'auto',
    'width' => '100%',
    'height' => '373px'];
$iframe = new Iframe();
$iframe->setSrc('https://spotthestation.nasa.gov/widget/widget.cfm?country=Finland&region=None&city=Turku')
        ->setLazy()
        ->setStyles($inlineStyles);
$widget = (new Iframe('http://193.64.245.223/basket/widget/'))
        ->setStyles($inlineStyles)
        ->setLazy()
        ->setStyle('border', 'none');
$grid = new Grid([$iframe, $widget]);
$grid->printHtml();
?>
