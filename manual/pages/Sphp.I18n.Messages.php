<?php

namespace Sphp\I18n\Messages;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Translatable;
use Sphp\I18n\TranslatorAwareTrait;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$messageInterface = Apis::sami()->classLinker(MessageInterface::class);
$translatable = Apis::sami()->classLinker(Translatable::class);
$message = Apis::sami()->classLinker(Message::class);
$messageContainer = Apis::sami()->classLinker(TranslatablePriorityList::class);
$messageCollectionInterfaces = Apis::sami()->classLinker(TranslatableCollectionInterface::class);
$echo = Apis::phpManual()->functionLink('echo');
$print = Apis::phpManual()->functionLink('print');
$string = Apis::phpManual()->typeLink('string');
$vsprintfLink = Apis::phpManual()->functionLink('vsprintf');

$translator = Apis::sami()->classLinker(TranslatorInterface::class);

\Sphp\Manual\parseDown(<<<MD
##Message systems <small>For verbose localized messaging</small>

$ns
###Localized messages <small>using $messageInterface objects</small>

A $messageInterface message provides support for formatted string syntax used in 
PHP's native $vsprintfLink function. Additionally arguments used in the formatted 
string can also be translated to other languages. 

When a message object is treated as a $string ($echo, $print...) 
it is translated according to the current settings of its $translator object.
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Messages/MessageInterface.php', 'text', false);

$translatorChangerObserverInterface = Apis::sami()->classLinker(Translatable::class);
$translatorChangerChainInterface = Apis::sami()->classLinker(TranslatorAwareTrait::class);

\Sphp\Manual\parseDown(<<<MD
###$messageCollectionInterfaces <small>for $translatable object grouping</small>

The $messageContainer class is a kind of priority list for $message objects. The 
traversal order of the messages in the container depends on the priority given 
to each message during insertion. If multiple messages have same priority the 
traversal order and the order of insertion are equal.

####$translatable object translation within the $messageContainer class

Changing the $translator of the $messageContainer changes it also in the inhered 
$translatable objects. The $messageContainer simply propagates the new translator 
to all of these objects inside the collection.

MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Messages/TranslatableCollection.php', 'text', false);
$translatableList = Apis::sami()->classLinker(TranslatableList::class);
$messageContainers = Apis::sami()->classLinker(TranslatableCollectionInterface::class);

$arrayaccess = Apis::phpManual()->classLinker(\ArrayAccess::class);
\Sphp\Manual\parseDown(<<<MD

 $translatableList objects can also be nested easily. 
extends $arrayaccess and the offset value corresponds this topic.

MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Messages/TranslatableCollection.nested.php', 'text', false);
