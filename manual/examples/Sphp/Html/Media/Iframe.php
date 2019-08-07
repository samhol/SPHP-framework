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

$widget = (new Iframe('https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1968.6436457032405!2d22.300180715499756!3d60.43458932895583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x468c7727a6466e41%3A0xa7ad26a37594a821!2sRakuunatie+59%2C+20720+Turku!5e0!3m2!1sen!2sfi!4v1565166196128!5m2!1sen!2sfi'))
        ->setLazy();
$widget->inlineStyles()->setProperties($inlineStyles);
$widget->printHtml();
