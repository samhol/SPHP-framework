<?php

namespace Sphp\Security;

use Sphp\Manual;

$passwordInterface = Manual\api()->classLinker(PasswordInterface::class);
$password = Manual\api()->classLinker(Password::class);

Manual\md(<<<MD
##Managing user Passwords <small>with $password</small>
$passwordInterface defines a verifiable password. It is implemented in an 
instantiable class $password.
MD
);
Manual\visualize('Sphp/Security/PasswordInterface.php', 'text', false);
