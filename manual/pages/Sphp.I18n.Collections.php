<?php

namespace Sphp\I18n\Collections;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Translatable;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$translatable = \Sphp\Manual\api()->classLinker(Translatable::class);
$translatablePriorityList = \Sphp\Manual\api()->classLinker(TranslatablePriorityList::class);
$messageCollectionInterfaces = \Sphp\Manual\api()->classLinker(TranslatableCollectionInterface::class);
$echo = Apis::phpManual()->functionLink('echo');
$print = Apis::phpManual()->functionLink('print');
$string = Apis::phpManual()->typeLink('string');
$vsprintfLink = Apis::phpManual()->functionLink('vsprintf');

$translator = \Sphp\Manual\api()->classLinker(TranslatorInterface::class);
$translatableList = \Sphp\Manual\api()->classLinker(TranslatableCollection::class);



\Sphp\Manual\parseDown(<<<MD
##Translatable collections <small>managing groups of $translatable objects</small>
$ns
$messageCollectionInterfaces is is the base interface for all translatable collections.

* $translatableList provides an indexed mutable list for translatable objects
* $translatablePriorityList is a priority list for handling $translatable objects. It is a stable priority list.


MD
);
CodeExampleAccordionBuilder::build('Sphp/I18n/Collections/TranslatableCollection.php', 'text', false)
        ->setExamplePaneTitle('Basic example of translatable collection')
        ->printHtml();
$messageContainers = \Sphp\Manual\api()->classLinker(TranslatableCollectionInterface::class);

$arrayaccess = Apis::phpManual()->classLinker(\ArrayAccess::class);
\Sphp\Manual\parseDown(<<<MD

$translatableList objects can also be nested easily. 
extends $arrayaccess and the offset value corresponds this topic.

MD
);
CodeExampleAccordionBuilder::build('Sphp/I18n/Collections/TranslatableCollection.nested.php', 'text', false)
        ->setExamplePaneTitle('An example of nesting translatable collections')
        ->printHtml();
\Sphp\Manual\parseDown(<<<MD

An instance of $translatablePriorityList is a priority list for handling $translatable objects. It is also a stable priority list.


MD
);
CodeExampleAccordionBuilder::build('Sphp/I18n/Collections/PriorityList.php', 'text', false)
        ->setExamplePaneTitle('An example of nesting translatable collections')
        ->printHtml();
