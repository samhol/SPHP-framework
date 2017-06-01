<?php

namespace Sphp\Html\Foundation\Sites\Containers\OffCanvas;

$offCanvas = (new OffCanvas('absolute'));
$offCanvas->leftMenu()->append('left');
$offCanvas->rightMenu()->append('right');
$offCanvas->mainContent()->append($offCanvas->leftMenu()->getOpener());
$offCanvas->mainContent()->append($offCanvas->rightMenu()->getOpener());
$offCanvas->mainContent()
        ->append(
                (new \Sphp\Html\Foundation\Sites\Bars\TitleBar())
                ->left($offCanvas->leftMenu()->getOpener()));
$offCanvas->mainContent()->appendMdFile('manual/snippets/loremipsum.md');

$data = [
    'l' => [
        'opener' => $offCanvas->leftMenu()->getOpener(),
        'title' => 'Left side',
    ],
    'r' => [
        'opener' => $offCanvas->rightMenu()->getOpener(),
        'title' => 'Right side'
    ]
];
echo \Sphp\Html\Foundation\Sites\Bars\TitleBarFactory::create($data);

$offCanvas->printHtml();

