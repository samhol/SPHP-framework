<?php

namespace Sphp\Html\Media\Icons;

echo Filetype::txt()->setSize('2x') . " ";
echo Filetype::html()->setSize('3x') . " ";
echo Filetype::python()->setSize('4x') . " ";
echo Filetype::php()->setSize('5x') . " ";
echo Filetype::get('foo.php')->setSize('6x') . " ";
echo Filetype::java()->setSize('7x') . " ";
echo Filetype::js()->setSize('8x') . " ";
echo FontAwesome::tumblr()->setSize('9x') . " ";
echo FontAwesome::twitter()->setSize('10x') . " ";
