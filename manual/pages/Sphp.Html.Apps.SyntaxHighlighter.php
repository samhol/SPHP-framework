<?php

namespace Sphp\Html\Apps;

$syntaxHighligher = $api->classLinker(SyntaxHighlighter::class);
$syntax1 = (new SyntaxHighlighter())
        ->loadFromFile("http://sphp.samiholck.com/HtmlWiki.html")
        ->setCssClass("panel");
echo $parsedown->text(<<<MD

##The $syntaxHighligher component
<div class="row"><div class="column small-12 large-5">

eahge eaer ea waer garar gewa g
         awea
         ga
         argwe
        a

</div><div class="column small-12 medium-7">$syntax1</div></div>
MD
);

$exampleViewer(EXAMPLE_DIR . "Sphp/Html/Apps/SyntaxHighlighter.php", 2);