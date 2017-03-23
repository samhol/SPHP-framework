<?php

namespace Sphp\Db;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$db = $api->classLinker(Db::class);
$pdo = Apis::phpManual()->classLinker(\PDO::class);

echo $parsedown->text(<<<MD
##The $db class

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Db.Query.php", true, false);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Db.Insert.php", true, false);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Db.Update.php", true, false);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Db.Delete.php", true, false);
CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/Db.Table.php", true, false);
