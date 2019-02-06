<?php

namespace Sphp\Html\Foundation\Sites\Buttons;

$buttonGroup = new ButtonGroup();
$buttonGroup->appendButton(new \Sphp\Html\Span("foo button"));
$buttonGroup->appendButton(Button::hyperlink("http://www.google.com/", "google", "engine"));
$buttonGroup->appendButton(Button::hyperlink("http://www.bing.com", "Bing", "engine"));
$buttonGroup->appendHyperlink("https://www.yahoo.com/", "Yahoo!", "engine");
$buttonGroup->setSize("tiny");

$buttonGroup->printHtml();

$buttonGroup->setExtended(true);
$buttonGroup->printHtml();

use Sphp\Html\Foundation\Sites\Containers\Dropdown;

$split = (new ButtonGroup())->setSize('small');
$split->appendPushButton('Push button')->setColor('alert');
$opener = $split->appendArrowOnlyButton('Dropdownopener');

$dd = new Dropdown($opener, "Hello! I'm a dropdown");

echo "$split {$dd->getDropdown()}";

$buttonGroup->setColor("success");
$buttonGroup->printHtml();

$buttonGroup->stackFor("all")
        ->printHtml();
