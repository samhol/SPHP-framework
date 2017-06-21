<?php

namespace Sphp\Html\Media;

$inlineStyles = [
    'overflow' => 'auto',
    'width' => '100%',
    'height' => '373px',
    'border', 'none'];
$iframe = new Iframe();
$iframe->setSrc('https://docs.google.com/present/embed?id=dcn37mcz_22cmnwnwf8')
        ->setWidth(200)
        ->setHeight(150)
        ->setLazy()
        ->printHtml();

$widget = (new Iframe('http://193.64.245.223/basket/widget/'))
        ->setLazy();
$widget->inlineStyles()->setProperties($inlineStyles);
$widget->printHtml();
