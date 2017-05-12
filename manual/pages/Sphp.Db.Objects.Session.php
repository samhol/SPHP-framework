<?php

namespace Sphp\Db\Objects;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$iterable = Apis::phpManual()->classLinker(\IteratorAggregate::class);
$sessionUser = Apis::sami()->classLinker(SessionUser::class);
$sessionUsers = Apis::sami()->classLinker(SessionUserStorage::class);

echo $parsedown->text(<<<MD
##$sessionUser objects and the $sessionUsers storage component
$sessionUser
MD
);
CodeExampleBuilder::visualize('Sphp/Db/Objects/SessionUser.php', 'text', false);

echo $parsedown->text(<<<MD
$sessionUsers
MD
);
CodeExampleBuilder::visualize('Sphp/Db/Objects/SessionUserStorage.php', 'text', false);
