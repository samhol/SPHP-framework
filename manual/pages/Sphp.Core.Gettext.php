<?php

namespace Sphp\Core\Gettext;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);

$gettext = $php->getExtensionLink("gettext", "Gettext");
echo $parsedown->text(<<<MD
#Native Language Support
        
The $gettext functions implement an NLS (Native Language Support) API which can 
be used to internationalize your PHP applications. Please see the gettext 
documentation for your system for a thorough explanation of these functions or 
view the docs at http://www.gnu.org/software/gettext/manual/gettext.html.
$ns
PHP has {$php->getExtensionLink('gettext')} to handle simple human language translation process.

By default, the {$php->getFunctionLink('gettext')} function  will use the `LC_CTYPE` 
of the chosen language (for example `en_US` or `fi_FI`). This `LC_CTYPE` is extracted 
from the `locales.alias` file in the servers configuration dir (Should be `/etc/locales.alias`).
By default, the encoding is frequently `iso-8859-1`.

**So to make an `UTF-8` aware translation PHP way:**

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/localeSetting.php", "Text", false);
echo $parsedown->text(<<<MD

However the framework offers an object oriented straightforward way for human 
language translation related processes.
		
**... the SPHP way:**

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/sphpTranslation.php", "Text", false);

$locale = $api->getClassLink(Locale::class);
$translator = $api->getClassLink(Translator::class);

echo $parsedown->text(<<<MD
##The $translator class

The $translator class is the base class for all human language translation related 
operations in this framework. It translates given input by using PHP's build in 
gettext extension and the current locale information provided by the $locale class.
		
The $translator class supports both basic...
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/Translator.singular.php", "Text", false);

echo $parsedown->text(<<<MD
...and plural Gettext translation.
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/Translator.plural.php", "Text", false);

$vsprintfLink = $php->getFunctionLink("vsprintf");
echo $parsedown->text(<<<MD
The $translator class has also a method similar to PHP's native $vsprintfLink 
function for both basic and plural translation. Additionally the class contain a 
method for translating a multidimensional array of message strings (plural form 
is not supported).
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/Translator.php", "Text", false);
$message =  $api->getClassLink(Message::class);
$messageContainer =  $api->getClassLink(MessageList::class);
$echo = $php->getFunctionLink("echo");
$print = $php->getFunctionLink("print");
$string = $php->getTypeLink("string");
echo $parsedown->text(<<<MD
##Localized messages using $message class

The $message class contains an immutable human language string that can be translated 
to other languages. When a $message object is treated like a $string ($echo, $print...) 
it is translated according to the systems locale settings by using a given $translator 
object. If no $translator is given the default translator is used.

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/Message.php", "Text", false);
$translatorChangerObserverInterface =  $api->getClassLink(TranslatorChangerObserverInterface::class);
$translatorChangerChainInterface =  $api->getClassLink(TranslatorChangerChainInterface::class);

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
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/MessageContainer.php", "Text", false);
$topicContainer =  $api->getClassLink(TopicList::class);
$messageContainers =  $api->getClassLink(MessageList::class, "MessageLists");

$arrayaccess = $php->getClassLink(\ArrayAccess::class);
echo $parsedown->text(<<<MD
##Grouping $messageContainers with a $topicContainer

The $topicContainer class groups $messageContainers by assosiating an individual 
index (topic) to each of them. $topicContainer extends $arrayaccess and the offset 
value corresponds this topic.

**Important:** As a $messageContainer is inserted into a $topicContainer it 
becomes also a $translatorChangerObserverInterface observer for this container.
		
$message object translation within a $topicContainer class works the same way as in a $messageContainer.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/TopicContainer.php", "Text", false);
$calendar =  $api->getClassLink(Calendar::class);
echo $parsedown->text(<<<MD
##Localized calendar related translations

The $calendar class.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Gettext/Calendar.php", "Text", false);

