<?php

namespace Sphp\Security;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
#Web application security
$ns
        
Security is a process, not a product, and adopting a sound approach to security 
during the process of application development will allow you to produce tighter, 
more robust code.
        
**Good articles about PHP web application security:**

* [PHP manual](http://php.net/manual/en/security.php){target="_blank"}
* [OWASP PHP Security Cheat Sheet](https://www.owasp.org/index.php/PHP_Security_Cheat_Sheet){target="_blank"}
* [Sitepoint](https://www.sitepoint.com/php-security-blunders/){target="_blank"}

MD
);

Manual\loadPage('Sphp.Security.Database');
Manual\loadPage('Sphp.Security.CRSFToken');
Manual\loadPage('Sphp.Security.PasswordInterface');

Manual\md(<<<MD
##Input validation
[Form Input validation](Sphp.Validators){target="_blank"}

MD
);

Manual\example('Sphp/Validators/FormValidator.php', 'php', false)
        ->setExamplePaneTitle('FORM input validation example')
        ->printHtml();
