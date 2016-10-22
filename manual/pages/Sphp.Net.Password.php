<?php
namespace Sphp\Net;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$pw = $api->classLinker(Password::class);
$hpw = $api->classLinker(HashedPassword::class);
echo $parsedown->text(<<<MD
##$pw and $hpw classes

$pw implements a plain password without any encryption functionality. However a $pw 
contains a method to generate a corresponding instance of $hpw. Both of these classes
have also methods to compare each other.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Net/Password.php", "php", false);
