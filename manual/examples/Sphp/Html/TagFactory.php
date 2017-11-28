<?php

namespace Sphp\Html;

$span = TagFactory::create("span", ['span tag']);
echo TagFactory::p("This is a paragraph contaning a $span");
