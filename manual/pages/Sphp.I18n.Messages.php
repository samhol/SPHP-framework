<?php

namespace Sphp\I18n\Messages;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Translatable;
use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$messageInterface = \Sphp\Manual\api()->classLinker(MessageInterface::class);
$translatable = \Sphp\Manual\api()->classLinker(Translatable::class);
$message = \Sphp\Manual\api()->classLinker(Message::class);
$string = Manual\php()->typeLink('string');
$echo = Manual\php()->functionLink('echo');
$print = Manual\php()->functionLink('print');
$vsprintfLink = Manual\php()->functionLink('vsprintf');
$translator = Manual\api()->classLinker(TranslatorInterface::class);

Manual\md(<<<MD
##Localized verbose messages <small>using $messageInterface objects</small>

$ns

A $messageInterface message provides support for formatted string syntax used in 
PHP's native $vsprintfLink function. Additionally arguments used in the formatted 
string can also be translated to other languages. 

When a message object is treated as a $string ($echo, $print...) 
it is translated according to the current settings of its $translator object.
MD
);
Manual\visualize('Sphp/I18n/Messages/MessageInterface.php', 'text', false);


