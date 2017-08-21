<?php

namespace Sphp\Net;

$netNS = $api->namespaceLink(__NAMESPACE__);
$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#NETWORKING
$ns
This namespace provides classes for implementing networking.

MD
);
\Sphp\Manual\loadPage("Sphp.Net.SessionHandler.php");
\Sphp\Manual\loadPage("Sphp.Core.Security.PasswordInterface.php");
