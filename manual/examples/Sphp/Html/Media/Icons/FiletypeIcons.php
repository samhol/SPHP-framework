<?php

namespace Sphp\Html\Media\Icons;

echo Filetype::txt("Text file icon")->setSize("2x") . " ";
echo Filetype::html()->setSize("3x") . " ";
echo Filetype::python()->setSize('4x') . " ";
echo Filetype::video()->setSize("5x") . " ";
echo Filetype::get("foo.php")->setSize('6x') . " ";
echo Filetype::java("Java icon")->setSize("7x") . " ";
echo Filetype::js("JavaScript icon")->setSize("8x") . " ";
echo Filetype::c("C icon")->setSize("9x") . " ";
echo Filetype::cpp("C++ icon")->setSize("10x") . " ";

$fileIcons = Filetype::instance();
echo $fileIcons->cpp("C++ icon")->setSize("10x") . " ";
echo $fileIcons('js', 'JavaScript icon');
