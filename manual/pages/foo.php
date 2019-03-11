<?php

use Sphp\Config\ShutDownRegister1;

echo '<pre>';

echo '</pre>';

use Sphp\Html\Foundation\Sites\Containers\Tabs\Tabs;

$tabs = new Tabs();
$tabs->matchHeight(true);
$tab = new \Sphp\Html\Foundation\Sites\Containers\Tabs\DivTab('Description');
$tab->appendMd(
        '##The $syntaxHighligher component'
);

$tabs->append($tab);
$tabs->setActive(0);

$syntax1 = (new Sphp\Html\Apps\Syntaxhighlighting\GeSHiSyntaxHighlighter())
        ->loadFromFile('manual/snippets/example1.js');
$tabs->appendTab('PHP code', $syntax1)->addCssClass('syntax-hl');
echo $tabs;
?>

