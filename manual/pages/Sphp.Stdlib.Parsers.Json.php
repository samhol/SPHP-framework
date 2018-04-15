<?php

namespace Sphp\Stdlib\Parsers;

use Sphp\Manual;
use Sphp\Stdlib\Parser;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$phpArray = Manual\php()->typeLink('array');

$json = Manual\api()->classLinker(Json::class);
Manual\md(<<<MD
##JSON <small>JavaScript Object Notation</small>

[JSON](https://www.json.org/) is a lightweight 
data-interchange format. It is based on a subset of the JavaScript Programming 
Language, Standard ECMA-262 3rd Edition - December 1999. JSON is a text format 
that is completely language independent.
  
A instance of $json class is able to transform JSON files and strings to PHP arrays and PHP arrays back to JSON files and strings.
        
MD
);

Manual\example('Sphp/Stdlib/Parsers/Markdown.php', 'html5', true)->setExamplePaneTitle('Examples of JSON parsing')->printHtml();
$jsonData = file_get_contents('http://data.samiholck.com/');
$yamlCode = Manual\codeModal('<i class="fab fa-js-square"></i> JSON data', 'manual/snippets/example.json', 'JSON data');
$yamlCodeButton = $yamlCode->getTrigger()->addCssClass('button', 'alert', 'radius', 'small');
$parsedYaml = Manual\codeModalFromString('<i class="fab fa-php"></i> PHP array', print_r(Parser::fromFile('manual/snippets/example.json'), true), 'text', 'JSON data as parsed PHP array');
$tr1 = $parsedYaml->getTrigger()->addCssClass('button', 'php', 'radius', 'small');


$buttonGroup = new ButtonGroup();
$buttonGroup->setSize('small');
$buttonGroup->appendButton($yamlCode->getTrigger());
$buttonGroup->appendButton($parsedYaml->getTrigger());
echo $buttonGroup . $yamlCode->getPopup() . $parsedYaml->getPopup();
