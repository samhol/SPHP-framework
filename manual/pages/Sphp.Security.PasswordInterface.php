<?php

namespace Sphp\Security;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$passwordInterface = \Sphp\Manual\api()->classLinker(PasswordInterface::class);
$password = \Sphp\Manual\api()->classLinker(Password::class);

\Sphp\Manual\parseDown(<<<MD
##Managing user Passwords <small>with $password</small>
$passwordInterface defines a verifiable password. It is implemented in an 
instantiable class $password.
MD
);
CodeExampleBuilder::visualize('Sphp/Security/PasswordInterface.php', 'text', false);
