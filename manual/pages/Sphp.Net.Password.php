<?php
namespace Sphp\Net;

use Sphp\Html\Foundation\F6\Containers\Accordions\CodeExampleAccordion as CodeExampleAccordion;

$pw = $api->getClassLink(Password::class);
$hpw = $api->getClassLink(HashedPassword::class);
echo $parsedown->text(<<<MD
##$pw and $hpw classes

$pw implements a plain password without any encryption functionality. However a $pw 
contains a method to generate a corresponding instance of $hpw. Both of these classes
have also methods to compare each other.

MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Net/Password.php", "php", false);
