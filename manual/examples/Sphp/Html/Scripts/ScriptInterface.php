<?php

namespace Sphp\Html\Scripts;

$scriptSrc = (new ScriptSrc("manual/snippets/example1.js"))
        ->printHtml();

$scriptCode = new ScriptCode('$user.fname = "Sami Petteri";');
$scriptCode[] = 'printUser($user);';
$scriptCode->printHtml();
