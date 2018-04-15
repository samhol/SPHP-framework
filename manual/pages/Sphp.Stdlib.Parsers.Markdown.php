<?php

namespace Sphp\Stdlib\Parsers;

use Sphp\Manual;
use Sphp\Stdlib\Parser;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$phpArray = Manual\php()->typeLink('array');

$md = Manual\api()->classLinker(Markdown::class);
Manual\md(<<<MD
##Markdown <small>markup language</small>
        
[Markdown](https://daringfireball.net/projects/markdown/)  is a lightweight markup language with plain text formatting syntax. It is designed so that it can be converted to HTML and many other formats using a tool by the same name.
        
A instance of $md class is able to transform Markdown files and strings to either inline or block level HTML syntax.
        
MD
);
use Sphp\Html\Foundation\Sites\Containers\Modal;
Manual\example('Sphp/Stdlib/Parsers/Markdown.php', 'html5', true)->setExamplePaneTitle('Examples of Markdown syntax parsing')->printHtml();

$mdCode = Manual\codeModal('<i class="far fa-file-code"></i> Markdown file', 'manual/snippets/example.md', '**Markdown** example');
$yamlCodeButton = $mdCode->getTrigger()->addCssClass('button', 'alert', 'radius', 'small');
$parsedMd = new Modal('<i class="fab fa-html5"></i> HTML code', Parser::fromFile('manual/snippets/example.md'));

$tr1 = $parsedMd->getTrigger()->addCssClass('button', 'php', 'radius', 'small');

$buttonGroup = new ButtonGroup();
$buttonGroup->setSize('small');
$buttonGroup->appendButton($mdCode->getTrigger());
$buttonGroup->appendButton($parsedMd->getTrigger());
echo $buttonGroup . $mdCode->getPopup() . $parsedMd->getPopup();
