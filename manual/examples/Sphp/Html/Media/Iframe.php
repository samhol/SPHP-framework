<?php

namespace Sphp\Html\Media;

use Sphp\Html\Foundation\Sites\Grids\Grid as Grid;

$inlineStyles = [
    'overflow' => 'auto',
    'width' => '100%',
    'height' => '373px'];
$iframe = new Iframe();
$iframe->setSrc('https://docs.google.com/present/embed?id=dcn37mcz_22cmnwnwf8')
        ->setLazy();

$iframe->inlineStyles()->setProperties($inlineStyles);
$widget = (new Iframe('http://193.64.245.223/basket/widget/'))
        ->setLazy();
$widget->inlineStyles()->set('border', 'none');
$grid = new Grid([$iframe, $widget]);
$grid->printHtml();
