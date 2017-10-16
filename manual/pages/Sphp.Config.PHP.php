<?php

namespace Sphp\Config;

use Sphp\Manual;

$php = Manual\api()->classLinker(PHP::class);
$phpConfig = Manual\api()->classLinker(PHPConfig::class);
$ini = Manual\api()->classLinker(Ini::class);

Manual\parseDown(<<<MD
##$php <small>is a runtime PHP environment manager container</small>

$php utility class handles common PHP configuration related tasks via build-in 
singleton $phpConfig and named $ini instances.

MD
);

Manual\loadPage('Sphp.Config.PHPConfig');
Manual\loadPage('Sphp.Config.Ini');
