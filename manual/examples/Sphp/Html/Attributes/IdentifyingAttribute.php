<?php

namespace Sphp\Html\Attributes;

use Sphp\Core\Types\Strings as Strings;

$observer = function($idAttr) {
  echo "<div $idAttr>ID: '" . $idAttr->getValue() . "'</div>\n";
};
$idAttr = (new IdentifyingAttribute("id"))
        ->attachIdentityObserver($observer);
$idAttr->identify()->set(Strings::generateRandomString(16));
$idAttr->lock("id_1")
        ->clear();
?>
