<?php

namespace Sphp\Html\Apps;

$ns = $api->getNamespaceLink(__NAMESPACE__);

$singleAccordion = $api->classLinker(SingleAccordion::class);
echo $parsedown->text(<<<MD

##The $singleAccordion component
MD
);