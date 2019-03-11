<?php

namespace Sphp\Stdlib;

error_reporting(E_ALL);
ini_set('display_errors', 1);
//require_once '../../../settings.php';
$str = Filesystem::executePhpToString('manual/templates/carousels/content/skills-md.php');
echo Parser::fromString($str, 'md');
