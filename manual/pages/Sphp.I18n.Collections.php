<?php

namespace Sphp\I18n\Collections;

use Sphp\I18n\TranslatorInterface;
use Sphp\I18n\Translatable;
use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$translatable = Manual\api()->classLinker(Translatable::class);
$translatablePriorityList = Manual\api()->classLinker(TranslatablePriorityList::class);
$messageCollectionInterfaces = Manual\api()->classLinker(TranslatableCollectionInterface::class);
$echo = Manual\php()->functionLink('echo');
$print = Manual\php()->functionLink('print');
$string = Manual\php()->typeLink('string');
$vsprintfLink = Manual\php()->functionLink('vsprintf');

$translator = Manual\api()->classLinker(TranslatorInterface::class);
$translatableList = Manual\api()->classLinker(TranslatableCollection::class);



Manual\md(<<<MD
##Translatable collections <small>managing groups of $translatable objects</small>
$ns
$messageCollectionInterfaces is is the base interface for all translatable collections.

* $translatableList provides an indexed mutable list for translatable objects
* $translatablePriorityList is a priority list for handling $translatable objects. It is a stable priority list.


MD
);
Manual\example('Sphp/I18n/Collections/TranslatableCollection.php', 'text', false)
        ->setExamplePaneTitle('Basic example of translatable collection')
        ->printHtml();

$messageContainers = Manual\api()->classLinker(TranslatableCollectionInterface::class);
$arrayaccess = Manual\php()->classLinker(\ArrayAccess::class);

Manual\md(<<<MD

$translatableList objects can also be nested easily. 
extends $arrayaccess and the offset value corresponds this topic.

MD
);

Manual\example('Sphp/I18n/Collections/TranslatableCollection.nested.php', 'text', false)
        ->setExamplePaneTitle('An example of nesting translatable collections')
        ->printHtml();

Manual\md(<<<MD

An instance of $translatablePriorityList is a priority list for handling $translatable objects. It is also a stable priority list.

MD
);

Manual\example('Sphp/I18n/Collections/PriorityList.php', 'text', false)
        ->setExamplePaneTitle('An example of nesting translatable collections')
        ->printHtml();
