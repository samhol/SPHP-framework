<?php

namespace Sphp\Core\Security;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$passwordInterface = $api->classLinker(PasswordInterface::class);
$pw = $api->classLinker(Password::class);
echo $parsedown->text(<<<MD
##$passwordInterface and $pw

$pw implements $passwordInterface. $pw has no public constructor but
contains static methods to generate instances from plain passwords or password hashes.

MD
);
CodeExampleBuilder::visualize('Sphp/Stdlib/Security/PasswordInterface.php', 'php', false);
