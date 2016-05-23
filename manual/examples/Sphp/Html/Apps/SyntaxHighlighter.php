<?php

namespace Sphp\Html\Apps;

use Sphp\Html\Foundation\Structure\Row as Row;

$syntax1 = (new SyntaxHighlighter())->loadFromFile(__FILE__);


$syntax2 = (new SyntaxHighlighter())
        ->loadFromFile(__FILE__)
        ->startLineNumbersAt(10);

$syntax3 = (new SyntaxHighlighter())
        ->loadFromFile(__FILE__)
        ->showLineNumbers(false);

$row = new Row();
$row->appendColumn($syntax1, 12, 6)
        ->appendColumn($syntax2, 12, 6)
        ->appendColumn($syntax3, 12, 6)
        ->printHtml();
?>
