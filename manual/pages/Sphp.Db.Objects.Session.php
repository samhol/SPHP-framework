<?php

namespace Sphp\Db\Objects;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$ns = $api->namespaceBreadGrumbs(__NAMESPACE__);
$iterable = $php->classLinker(\IteratorAggregate::class);
$sessionUser = $api->classLinker(SessionUser::class);
$sessionUsers = $api->classLinker(SessionUserStorage::class);

echo $parsedown->text(<<<MD
##$sessionUser objects and the $sessionUsers storage component
$sessionUser
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/SessionUser.php", "text", false);

echo $parsedown->text(<<<MD
$sessionUsers
MD
);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Objects/SessionUserStorage.php", "text", false);
