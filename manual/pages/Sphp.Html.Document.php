<?php

namespace Sphp\Html;

$documentClass = $api->classLinker(Document::class);
echo $parsedown->text(<<<MD
##The $documentClass class

The $documentClass class can act as a factory for basic HTML tag objects. Here are the 
grouped lists of the HTML5 components and the corresponding PHP types in Framework's HTML implementation.
MD
);
$load("htmlTagListArray.php");
