<?php

namespace Sphp\Html\Attributes;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$abstractAttrMngr = Apis::sami()->classLinker(AbstractAttributeManager::class);
$attributeObjectManager = Apis::sami()->classLinker(AttributeObjectManager::class);
$attributeInterface = Apis::sami()->classLinker(AttributeInterface::class);
$multiValueAttr = Apis::sami()->classLinker(MultiValueAttribute::class);
$propertyAttr = Apis::sami()->classLinker(PropertyAttribute::class);
$setMethodLink = $abstractAttrMngr->methodLink("set", false);
$removeMethodLink = $abstractAttrMngr->methodLink("remove", false);
$requireAttr = $abstractAttrMngr->methodLink("demand", false);
$lockAttr = $abstractAttrMngr->methodLink("lock", false);



\Sphp\Manual\parseDown(<<<MD
##$attributeObjectManager <small>for $attributeInterface management</small>

MD
);

CodeExampleBuilder::visualize('Sphp/Html/Attributes/AttributeObjectManager.php', 'html5', true);
