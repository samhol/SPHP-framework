<?php

namespace Sphp\Db;

use Sphp\Html\Apps\Manual\Apis;

$db = $api->classLinker(Db::class);
$pdo = Apis::phpManual()->classLinker(\PDO::class);

echo $parsedown->text(<<<MD
##The $db class

MD
);

$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Query.php", true, false);
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Insert.php", true, false);
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Update.php", true, false);
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Delete.php", true, false);
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Table.php", true, false);
