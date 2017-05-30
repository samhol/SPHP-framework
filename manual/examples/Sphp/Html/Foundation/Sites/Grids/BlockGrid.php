<?php

namespace Sphp\Html\Foundation\Sites\Grids;

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

(new BlockGrid([$img200, $img200, $img200, $img200], ['small-up-1', 'medium-up-2', 'xlarge-up-4']))
        ->printHtml();
(new BlockGrid([$img100, $img100, $img100, $img100], ['small-up-2', 'large-up-4']))
        ->printHtml();
(new BlockGrid([$img30, $img30, $img30, $img30, $img30, $img30, $img30, $img30], ['small-up-4', 'medium-up-8']))
        ->printHtml();
(new BlockGrid(range('a', 'h'), ['small-up-4', 'medium-up-8']))
        ->printHtml();
