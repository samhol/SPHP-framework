<?php

namespace Sphp\Html\Programming;

$scriptCode = new ScriptCode();
$scriptCode[] = 'var $me = {};';
$scriptCode[] = '$me.fname = "Sami";';
$scriptCode[] = 'document.write("I am " + $me.fname);';
$scriptCode->printHtml();
