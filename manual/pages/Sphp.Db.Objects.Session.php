<?php

namespace Sphp\Db\Objects;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$iterable = \Sphp\Manual\php()->classLinker(\IteratorAggregate::class);
$sessionUser = \Sphp\Manual\api()->classLinker(SessionUser::class);
$sessionUsers = \Sphp\Manual\api()->classLinker(SessionUserStorage::class);

\Sphp\Manual\md(<<<MD
##$sessionUser objects and the $sessionUsers storage component
$sessionUser
MD
);
\Sphp\Manual\visualize('Sphp/Db/Objects/SessionUser.php', 'text', false);

\Sphp\Manual\md(<<<MD
$sessionUsers
MD
);
\Sphp\Manual\visualize('Sphp/Db/Objects/SessionUserStorage.php', 'text', false);
