<?php

namespace Sphp\Db;

$db = $api->classLinker(Db::class);
$pdo = $php->classLinker(\PDO::class);

echo $parsedown->text(<<<MD
##The $db class

MD
);

$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Query.php", 2);
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Insert.php", 1, "text");
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Update.php", 1, "text");
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Delete.php", 1, "text");
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/Db.Table.php", 1, "text");
?>