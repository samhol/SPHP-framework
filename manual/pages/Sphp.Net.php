<?php

namespace Sphp\Net;

$netNS = $api->namespaceLink(__NAMESPACE__);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
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
