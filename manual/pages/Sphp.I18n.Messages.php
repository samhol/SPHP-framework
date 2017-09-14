<?php

namespace Sphp\I18n\Messages;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Translatable;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$messageInterface = Apis::sami()->classLinker(MessageInterface::class);
$translatable = Apis::sami()->classLinker(Translatable::class);
$message = Apis::sami()->classLinker(Message::class);
$echo = Apis::phpManual()->functionLink('echo');
$print = Apis::phpManual()->functionLink('print');
$string = Apis::phpManual()->typeLink('string');
$vsprintfLink = Apis::phpManual()->functionLink('vsprintf');

$translator = Apis::sami()->classLinker(TranslatorInterface::class);

\Sphp\Manual\parseDown(<<<MD
##Localized verbose messages <small>using $messageInterface objects</small>

$ns

A $messageInterface message provides support for formatted string syntax used in 
PHP's native $vsprintfLink function. Additionally arguments used in the formatted 
string can also be translated to other languages. 

When a message object is treated as a $string ($echo, $print...) 
it is translated according to the current settings of its $translator object.
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Messages/MessageInterface.php', 'text', false);


