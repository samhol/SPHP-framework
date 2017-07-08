<?php

namespace Sphp\Database;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$query = $api->classLinker(Query::class);
$pdo = Apis::phpManual()->classLinker(\PDO::class);

echo $parsedown->text(<<<MD
##The $query class

MD
);

CodeExampleBuilder::visualize('Sphp/Database/Query.php', 'sql', false);
CodeExampleBuilder::visualize("Sphp/Db/Db.Insert.php", true, false);
CodeExampleBuilder::visualize("Sphp/Db/Db.Update.php", true, false);
CodeExampleBuilder::visualize("Sphp/Db/Db.Delete.php", true, false);
CodeExampleBuilder::visualize("Sphp/Db/Db.Table.php", true, false);
