<?php

namespace Sphp\Security;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
\Sphp\Manual\parseDown(<<<MD
##Security solutions

This namespace provides classes for implementing networking.

MD
);


CodeExampleBuilder::visualize('Sphp/Security/PasswordInterface.php', 'text', false);

