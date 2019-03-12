<?php

namespace Sphp\Html\Apps\Syntaxhighlighting;

use Sphp\Html\Foundation\Sites\Containers\Tabs\Tabs;
//use Sphp\Html\Apps\Syntaxhighlighting\GeSHiSyntaxHighlighter;
use Sphp\Manual;
use Sphp\Html\Foundation\Sites\Containers\Tabs\SyntaxHighlightingTab;

$syntaxHighligher = Manual\api()->classLinker(GeSHiSyntaxHighlighter::class);

\Sphp\Manual\md(<<<MD

## The $syntaxHighligher component
        
Support for a wide range of popular languages
Easy to add a new language for highlighting
Highly customisable output formats

MD
);

$path = 'manual/snippets/syntaxhighlight';

$tabs = new Tabs();
$tabs->matchHeight(true);
$cssTab = new SyntaxHighlightingTab('CSS');
$cssTab->loadFromFile("$path/example.css");
$tabs->append($cssTab);

$jsonTab = new SyntaxHighlightingTab('JSON');
$jsonTab->loadFromFile("$path/example.json");
$tabs->append($jsonTab);

$phpTab = new SyntaxHighlightingTab('PHP');
$phpTab->loadFromFile("$path/example.php");
$tabs->append($phpTab);

$jsTab = new SyntaxHighlightingTab('JS');
$jsTab->loadFromFile("$path/example.js");
$tabs->append($jsTab);

$tabs->setActive(0);
echo $tabs;
?>
