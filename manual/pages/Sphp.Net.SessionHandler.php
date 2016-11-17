<?php
namespace Sphp\Net;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
$sessionHandlerInterface = $api->classLinker(\SessionHandlerInterface::class);
$abstractSessionHandler = $api->classLinker(AbstractSessionHandler::class);
echo $parsedown->text(<<<MD
##$sessionHandlerInterface implementations

$abstractSessionHandler

MD
);

(new SyntaxHighlightingSingleAccordion())
		->loadFromFile(\Sphp\PDO_SESSIONING)
		->printHtml();
