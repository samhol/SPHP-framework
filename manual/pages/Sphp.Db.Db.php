<?php

namespace Sphp\Db;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$db = $api->classLinker(Db::class);
$pdo = Apis::phpManual()->classLinker(\PDO::class);

\Sphp\Manual\parseDown(<<<MD
##The $db class

MD
);

CodeExampleBuilder::visualize("Sphp/Db/Db.Query.php", true, false);
CodeExampleBuilder::visualize("Sphp/Db/Db.Insert.php", true, false);
CodeExampleBuilder::visualize("Sphp/Db/Db.Update.php", true, false);
CodeExampleBuilder::visualize("Sphp/Db/Db.Delete.php", true, false);
CodeExampleBuilder::visualize("Sphp/Db/Db.Table.php", true, false);
