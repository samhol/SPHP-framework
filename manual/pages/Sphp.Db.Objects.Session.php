<?php

namespace Sphp\Db\Objects;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$iterable = Apis::phpManual()->classLinker(\IteratorAggregate::class);
$sessionUser = \Sphp\Manual\api()->classLinker(SessionUser::class);
$sessionUsers = \Sphp\Manual\api()->classLinker(SessionUserStorage::class);

\Sphp\Manual\parseDown(<<<MD
##$sessionUser objects and the $sessionUsers storage component
$sessionUser
MD
);
CodeExampleAccordionBuilder::visualize('Sphp/Db/Objects/SessionUser.php', 'text', false);

\Sphp\Manual\parseDown(<<<MD
$sessionUsers
MD
);
CodeExampleAccordionBuilder::visualize('Sphp/Db/Objects/SessionUserStorage.php', 'text', false);
