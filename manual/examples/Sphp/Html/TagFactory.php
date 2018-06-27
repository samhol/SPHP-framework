<?php

namespace Sphp\Html;

$span = Tags::create("span", ['span tag']);
echo Tags::p("This is a paragraph contaning a $span");
