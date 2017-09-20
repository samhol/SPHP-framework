<?php

namespace Sphp\Security;
use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
#WEB APPLICATION SECURITY
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

\Sphp\Manual\loadPage("Sphp.Security.Database.php");
\Sphp\Manual\loadPage("Sphp.Security.CRSFToken.php");
\Sphp\Manual\loadPage("Sphp.Security.PasswordInterface.php");
\Sphp\Manual\parseDown(<<<MD
##Input validation
[Form Input validation](Sphp.Validators){target="_blank"}

MD
);
CodeExampleBuilder::build('Sphp/Validators/FormValidator.php', "php", false)
        ->setExamplePaneTitle('FORM input validation example')
        ->printHtml();
