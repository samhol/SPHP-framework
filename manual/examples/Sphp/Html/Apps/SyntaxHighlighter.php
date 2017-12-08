<?php

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$syntax1 = (new SyntaxHighlighter())->loadFromFile(__FILE__);


$syntax2 = (new SyntaxHighlighter())
        ->loadFromFile(__FILE__);

$syntax3 = (new SyntaxHighlighter())
        ->loadFromFile(__FILE__)
        ->showLineNumbers(false);

$row = new BlockGrid('small-up-2');
$row->append($syntax1)
        ->append($syntax2)
        ->append($syntax3)
        ->printHtml();
