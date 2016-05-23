<?php

namespace Sphp\Net;

$netNS = $api->getNamespaceLink(__NAMESPACE__);
$ns = $api->getNamespaceBreadGrumbs(__NAMESPACE__);
echo $parsedown->text(<<<MD
#NETWORKING
$ns
This namespace provides classes for implementing networking.

MD
);
$load("Sphp.Net.SessionHandler.php");
$load("Sphp.Net.URL.php");
$load("Sphp.Net.Password.php");
?>
