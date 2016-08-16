<?php

namespace Sphp\Db;

$delete = $api->classLinker(Delete::class);

echo $parsedown->text(<<<MD

###SQL database $delete object

The $delete object removes one or more records from a table. A subset may be 
defined for deletion using a condition, otherwise all records are removed. 
	
Some DBMSs, like MySQL, allow to delete rows from multiple tables with one SQL 
DELETE statement.
MD
);
$exampleViewer(EXAMPLE_DIR . "Sphp/Db/delete1.php", true, "sql");
?>