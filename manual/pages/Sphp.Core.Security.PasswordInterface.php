<?php
namespace Sphp\Core\Security;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$passwordInterface = $api->classLinker(PasswordInterface::class);
$pw = $api->classLinker(Password::class);
echo $parsedown->text(<<<MD
##$passwordInterface and $pw

$pw implements $passwordInterface. $pw has no public constructor but
contains static methods to generate instances from plain passwords or password hashes.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Security/PasswordInterface.php", "php", false);
