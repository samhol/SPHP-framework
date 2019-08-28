<?php

namespace Sphp\Html\Media\Icons;

$list = new \Sphp\Html\Lists\Ul();
$list->addCssClass('fa-2x');
$list->append(FileIcons::txt("Text file icon"));
$list->append(FileIcons::html());
$list->append(FileIcons::python());
$list->append(FileIcons::video());
$list->append(FileIcons::php("foo.php"));
$list->append(FileIcons::java("Java icon"));
$list->append(FileIcons::js("JavaScript icon"));
$list->append(FileIcons::c("C icon"));
$list->append(FileIcons::cpp("C++ icon"));
echo $list;

$fileIcons = FileIcons::instance();
echo $fileIcons->cpp("C++ icon") . " ";
echo $fileIcons('js', 'JavaScript icon');
/*
echo FileIcons::txt("Text file icon")->setSize("2x") . " ";
echo FileIcons::html()->setSize("3x") . " ";
echo FileIcons::python()->setSize('4x') . " ";
echo FileIcons::video()->setSize("5x") . " ";
echo FileIcons::php("foo.php")->setSize('6x') . " ";
echo FileIcons::java("Java icon")->setSize("7x") . " ";
echo FileIcons::js("JavaScript icon")->setSize("8x") . " ";
echo FileIcons::c("C icon")->setSize("9x") . " ";
echo FileIcons::cpp("C++ icon")->setSize("10x") . " ";

$fileIcons = FileIcons::instance();
echo $fileIcons->cpp("C++ icon")->setSize("10x") . " ";
echo $fileIcons('js', 'JavaScript icon');
*/
