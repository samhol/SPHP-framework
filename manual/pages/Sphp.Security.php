<?php

namespace Sphp\Security;
use Sphp\Html\Apps\Manual\Apis;
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#Security solutions
$ns
This namespace provides classes for implementing networking.

MD
);
//\Sphp\Manual\loadPage("Sphp.Net.SessionHandler.php");
\Sphp\Manual\loadPage("Sphp.Security.CRSFToken.php");
\Sphp\Manual\loadPage("Sphp.Security.PasswordInterface.php");
