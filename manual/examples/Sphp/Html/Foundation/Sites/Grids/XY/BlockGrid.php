<?php

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Html\Media\Img;

$img200 = (new Img("http://placehold.it/200x200/c0c0c0/333?text=foo-box", '200x200 foo'))
        ->addCssClass('thumbnail')
        ->setLazy(true);
$img100 = (new Img("http://placehold.it/100x100/aaa/333?text=foo-box", '100x100 foo'))
        ->addCssClass('thumbnail')
        ->setLazy(true);
$img30 = (new Img("http://placehold.it/30x30/c0c0c0/333?text=foo", '30x30 foo'))
        ->addCssClass('thumbnail')
        ->setLazy(true);

(new BlockGrid(['small-up-1', 'medium-up-2', 'xlarge-up-4'], [$img200, $img200, $img200, $img200]))
        ->printHtml();
(new BlockGrid(['small-up-2', 'large-up-4'], [$img100, $img100, $img100, $img100]))
        ->printHtml();
(new BlockGrid(['small-up-4', 'medium-up-8'], [$img30, $img30, $img30, $img30, $img30, $img30, $img30, $img30]))
        ->printHtml();
(new BlockGrid(['small-up-4', 'medium-up-8'], range('a', 'h')))
        ->printHtml();
