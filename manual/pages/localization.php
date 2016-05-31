<?php

namespace Sphp\Core\Gettext;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

echo $parsedown->text(<<<MD
#Localization and internalization using classes in {$api->getNamespaceLink(__NAMESPACE__)} namespace

PHP has a messy way (just my own opinion) to handle simple human language translation process.

By default, the {$php->getFunctionLink('gettext')} function  will use the `LC_CTYPE` 
of the chosen language (for example `en_US` or `fi_FI`). This `LC_CTYPE` is extracted 
from the `locales.alias` file in the servers configuration dir (Should be `/etc/locales.alias`).
By default, the encoding is frequently `iso-8859-1`.

**So to make an `UTF-8` aware translation PHP way:**

MD
);

(new CodeExampleViewer(EXAMPLE_DIR . "Sphp/Gettext/localeSetting.php", true, "php"))
		->setExampleHeading("Example code")
		->setOutputHeading("The translation result")
		->printHtml();
echo $parsedown->text(<<<MD

However the framework offers an objectoriented straightforward way for human 
language translation related processes.
		
**... the SPHP way:**

MD
);
(new CodeExampleViewer(EXAMPLE_DIR . "Sphp/Gettext/sphpTranslation.php", true, "php"))
		->setExampleHeading("... the SPHP way:")
		->setOutputHeading("The translation result")
		->printHtml();

$locale = $api->getClassLink(Locale::class);
//$dictionary = $api->getClassLink(Dictionary::class);
$translator = $api->getClassLink(Translator::class);
echo $parsedown->text(<<<MD
	
##The $translator component

$translator components form is the base for all human language translation related 
operations in this framework. An instance of $translator translates given input by using PHP's build in 
gettext property and the current locale information provided by the $locale class.
MD
);
(new CodeExampleViewer(EXAMPLE_DIR . "Sphp/Gettext/Translator.singular.php", true, "php"))
		->setExampleHeading("Singular example")
		->printHtml();
(new CodeExampleViewer(EXAMPLE_DIR . "Sphp/Gettext/Translator.plural.php", true, "php"))
		->setExampleHeading("Plural example")
		->printHtml();
//PHPExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Gettext/Dictionary.php", true, "php");

CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Gettext/translator.php", true, "php");
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

CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Gettext/Message.php", true, "php");
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
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Gettext/MessageContainer.php", true, "php");
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
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Gettext/TopicContainer.php", true, "php");
$calendar =  $api->getClassLink(Calendar::class);
echo $parsedown->text(<<<MD
##Localized calendar related translations

The $calendar class.

MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Gettext/Calendar.php", true, "php");

//include_once __DIR__.'/../manualTools/poViewer.php';