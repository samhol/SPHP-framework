<?php

namespace Sphp\Html;

$documentLink = $api->getClassLink(Doc::class);
echo $parsedown->text(<<<MD
###The $documentLink class

The $documentLink class can act as a factory for basic HTML tag objects. Here are the 
grouped lists of the HTML5 components and the corresponding PHP types in Framework's HTML implementation.
MD
);
$load("htmlTagListArray.php");
