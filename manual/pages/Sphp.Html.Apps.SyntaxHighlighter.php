<?php

namespace Sphp\Html\Apps\Syntaxhighlighting;
use Sphp\Manual;
$syntaxHighligher = Manual\api()->classLinker(GeSHiSyntaxHighlighter::class);
$syntax1 = (new GeSHiSyntaxHighlighter())
        ->loadFromFile('manual/snippets/example1.js');
\Sphp\Manual\md(<<<MD

##The $syntaxHighligher component
<div class="row"><div class="column small-12 large-5">



</div><div class="column small-12 medium-7">$syntax1</div></div>
MD
);
