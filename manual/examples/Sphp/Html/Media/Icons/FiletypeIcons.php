<?php

namespace Sphp\Html\Media\Icons;

$fileIcons = new FileIcons('span');
$list = new \Sphp\Html\Lists\Ul();
$list->addCssClass('fa-2x no-bullet');
$list->append(FileIcons::txt("Text file icon"));
$list->append(FileIcons::html());
$list->append(FileIcons::python());
$list->append(FileIcons::video());
$list->append(FileIcons::php("foo.php"));
$list->append(FileIcons::java("Java icon"));
$list->append(FileIcons::js("JavaScript icon"));
$list->append(FileIcons::c("C icon"));
$list->append($fileIcons->cpp("C++ icon"));
echo $list;
