<?php

namespace Sphp\I18n\Messages;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Translatable;
use Sphp\I18n\TranslatorAwareTrait;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$php = Apis::phpManual();
$gettext = Apis::phpManual()->extensionLink("gettext", "Gettext");
$messageInterface = $api->classLinker(MessageInterface::class);
$templateInterface = $api->classLinker(TemplateInterface::class);
$translatable = $api->classLinker(Translatable::class);
$message = $api->classLinker(Message::class);
$messageContainer = $api->classLinker(TranslatablePriorityList::class);
$messageCollectionInterfaces = $api->classLinker(TranslatableCollectionInterface::class);
$echo = $php->functionLink("echo");
$print = $php->functionLink("print");
$string = $php->typeLink("string");
$vsprintfLink = $php->functionLink("vsprintf");

$translator = $api->classLinker(TranslatorInterface::class);

echo $parsedown->text(<<<MD
##Message systems <small>For verbose localized messaging</small>

$ns
MD
);
echo $parsedown->text(<<<MD
###$templateInterface <small>Localization string templates</small>

A $templateInterface object contains an immutable string that can be translated 
to other languages. 

When a template object is treated as a $string ($echo, $print...) 
it is translated according to the current settings of its $translator object.
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Messages/TemplateInterface.php', 'text', false);

echo $parsedown->text(<<<MD
###Localized messages using $messageInterface objects

A $messageInterface class contains a $templateInterface and provides additional 
support for formatted string syntax used in PHP's native $vsprintfLink function. 
Additionally arguments used in the formatted string can also be translated.
to other languages. 

When a message object is treated as a $string ($echo, $print...) 
it is translated according to the current settings of its $translator object.
MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Messages/MessageInterface.php', 'text', false);

$translatorChangerObserverInterface = $api->classLinker(Translatable::class);
$translatorChangerChainInterface = $api->classLinker(TranslatorAwareTrait::class);

echo $parsedown->text(<<<MD
###$messageCollectionInterfaces <small>for message object grouping</small>

The $messageContainer class is a kind of priority list for $message objects. The 
traversal order of the messages in the container depends on the priority given 
to each message during insertion. If multiple messages have same priority the 
traversal order and the order of insertion are equal.

####$message object translation within the $messageContainer class

Changing the $translator of the $messageContainer changes it also in the inhered 
$translatable objects. The $messageContainer simply propagates the new translator 
to all of these objects inside the collection.

MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Messages/TranslatableCollection.php', 'text', false);
$topicContainer = $api->classLinker(TopicList::class);
$messageContainers = $api->classLinker(TranslatableCollectionInterface::class);

$arrayaccess = $php->classLinker(\ArrayAccess::class);
echo $parsedown->text(<<<MD
##Grouping $messageContainers with a $topicContainer

The $topicContainer class groups $translatable components like $messageContainers 
objets by assosiating an individual index (topic) to each of them. $topicContainer 
extends $arrayaccess and the offset value corresponds this topic.

MD
);
CodeExampleBuilder::visualize('Sphp/I18n/Messages/TopicContainer.php', 'text', false);
