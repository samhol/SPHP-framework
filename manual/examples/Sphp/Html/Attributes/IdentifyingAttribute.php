<?php

namespace Sphp\Html\Attributes;

$observer = function($idAttr) {
  echo "<div $idAttr>ID: '" . $idAttr->getValue() . "'</div>\n";
};
$idAttr = (new IdentifyingAttribute("id"))
        ->attachAttributeChangeObserver($observer);
$idAttr->identify()->set(\Sphp\Util\Strings::generateRandomString(16));
$idAttr->lock("id_1")
        ->clear();
?>