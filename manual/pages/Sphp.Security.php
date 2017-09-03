<?php

namespace Sphp\Security;
use Sphp\Html\Apps\Manual\Apis;
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#Security solutions
$ns
        
Security is a process, not a product, and adopting a sound approach to security 
during the process of application development will allow you to produce tighter, 
more robust code.
        
Good articles about PHP web application security:

* [PHP manual](http://php.net/manual/en/security.php){target="_blank"}
* [Sitepoint](https://www.sitepoint.com/php-security-blunders/){target="_blank"}
        
##Input validation

MD
);
//\Sphp\Manual\loadPage("Sphp.Net.SessionHandler.php");
\Sphp\Manual\loadPage("Sphp.Security.CRSFToken.php");
\Sphp\Manual\loadPage("Sphp.Security.PasswordInterface.php");
