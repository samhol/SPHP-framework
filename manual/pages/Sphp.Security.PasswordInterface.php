<?php

namespace Sphp\Security;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;

$passwordInterface = \Sphp\Manual\api()->classLinker(PasswordInterface::class);
$password = \Sphp\Manual\api()->classLinker(Password::class);

\Sphp\Manual\md(<<<MD
##Managing user Passwords <small>with $password</small>
$passwordInterface defines a verifiable password. It is implemented in an 
instantiable class $password.
MD
);
CodeExampleAccordionBuilder::visualize('Sphp/Security/PasswordInterface.php', 'text', false);
