<?php
namespace Sphp\Net;

use Sphp\Html\Foundation\F6\Containers\Accordions\SyntaxHighlightingSingleAccordion as SyntaxHighlighter;
$sessionHandlerInterface = $api->getClassLink(\SessionHandlerInterface::class);
$abstractSessionHandler = $api->getClassLink(AbstractSessionHandler::class);
$hpw = $api->getClassLink(HashedPassword::class);
echo $parsedown->text(<<<MD
##$sessionHandlerInterface implementations

$abstractSessionHandler

MD
);

(new SyntaxHighlighter())
		->loadFromFile(\Sphp\PDO_SESSIONING, "Session example <code>PHP</code> code")
		->printHtml();
