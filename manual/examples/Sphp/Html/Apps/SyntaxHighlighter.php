<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Foundation\F6\Grids\BlockGrid as BlockGrid;

$syntax1 = (new SyntaxHighlighter())->loadFromFile(__FILE__);


$syntax2 = (new SyntaxHighlighter())
        ->loadFromFile(__FILE__)
        ->startLineNumbersAt(10);

$syntax3 = (new SyntaxHighlighter())
        ->loadFromFile(__FILE__)
        ->showLineNumbers(false);

$row = new BlockGrid();
$row->append($syntax1)
        ->append($syntax2)
        ->append($syntax3)
        ->printHtml();
?>
