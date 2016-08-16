<?php

namespace Sphp\Db;

use Sphp\Html\Apps\ApiTools\PHPExampleViewer as CodeExampleViewer;

$update = $api->classLinker(Update::class);
$conditions = $api->classLinker(Conditions::class);
$pdo = $php->classLinker(\PDO::class);

echo $parsedown->text(<<<MD

##SQL database $update object
		
The $update object executes declarative **UPDATE** statement in SQL databases.

An $update object changes the data of one or more records in a table. Either all 
the rows can be updated, or a subset may be chosen using $conditions member 
object from {$update->method("where")}.
MD
);
CodeExampleViewer::visualize(EXAMPLE_DIR . "Sphp/Db/update1.php", true, "sql");
?>