<?php

namespace Sphp\Html\Apps;

$syntaxHighligher = $api->classLinker(SyntaxHighlighter::class);
$syntax1 = (new SyntaxHighlighter())
        ->loadFromFile('manual/snippets/example1.js');
echo $parsedown->text(<<<MD

##The $syntaxHighligher component
<div class="row"><div class="column small-12 large-5">



</div><div class="column small-12 medium-7">$syntax1</div></div>
MD
);