<?php

namespace Sphp\I18n\Messages;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\I18n\TranslatorInterface;

use Sphp\I18n\TranslatorAwareTrait;
use Sphp\I18n\TranslatorAwareInterface;
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$php = Apis::phpManual();
$gettext = Apis::phpManual()->extensionLink("gettext", "Gettext");


$translator = $api->classLinker(TranslatorInterface::class);

echo $parsedown->text(<<<MD
##Message system <small>For verbose translations</small>

$ns
MD
);

CodeExampleBuilder::visualize("Sphp/I18n/Messages/TemplateInterface.php", "text", false);

echo $parsedown->text(<<<MD
...and plural Gettext translation.
MD
);
CodeExampleBuilder::visualize("Sphp/I18n/Messages/MessageInterface.php", "text", false);

$vsprintfLink = $php->functionLink("vsprintf");
echo $parsedown->text(<<<MD
The $translator class has also a method similar to PHP's native $vsprintfLink 
function for both basic and plural translation. Additionally the class contain a 
method for translating a multidimensional array of message strings (plural form 
is not supported).
MD
);
CodeExampleBuilder::visualize("Sphp/I18n/Translator.php", "text", false);
$message = $api->classLinker(Message::class);
$messageContainer = $api->classLinker(PrioritizedMessageList::class);
$echo = $php->functionLink("echo");
$print = $php->functionLink("print");
$string = $php->typeLink("string");
echo $parsedown->text(<<<MD
##Localized messages using $message class

The $message class contains an immutable human language string that can be translated 
to other languages. When a $message object is treated like a $string ($echo, $print...) 
it is translated according to the systems locale settings by using a given $translator 
object. If no $translator is given the default translator is used.

MD
);

CodeExampleBuilder::visualize("Sphp/I18n/Message.php", "text", false);
$translatorChangerObserverInterface = $api->classLinker(TranslatorAwareInterface::class);
$translatorChangerChainInterface = $api->classLinker(TranslatorAwareTrait::class);

echo $parsedown->text(<<<MD
##$message grouping and prioritizing with $messageContainer class

The $messageContainer class is a kind of priority list for $message objects. The 
traversal order of the messages in the container depends on the priority given 
to each message during insertion. If multiple messages have same priority the 
traversal order and the order of insertion are equal.

**Important:** A $message inserted becomes also a $translatorChangerObserverInterface 
observer for its container.
		
####$message object translation within the $messageContainer class

Changing the $translator of the $messageContainer changes it also in the inhered 
$message objects. The $messageContainer simply propagates the new translator to 
its messages by notifying them via the $translatorChangerChainInterface.

MD
);
CodeExampleBuilder::visualize("Sphp/I18n/MessageContainer.php", "text", false);
$topicContainer = $api->classLinker(TopicList::class);
$messageContainers = $api->classLinker(MessageCollectionInterface::class);

$arrayaccess = $php->classLinker(\ArrayAccess::class);
echo $parsedown->text(<<<MD
##Grouping $messageContainers with a $topicContainer

The $topicContainer class groups $messageContainers objets by assosiating an individual 
index (topic) to each of them. $topicContainer extends $arrayaccess and the offset 
value corresponds this topic.

**Important:** As a $messageContainer is inserted into a $topicContainer it 
becomes also a $translatorChangerObserverInterface observer for this container.
		
$message object translation within a $topicContainer class works the same way as in a $messageContainer.

MD
);
CodeExampleBuilder::visualize("Sphp/I18n/TopicContainer.php", "text", false);
