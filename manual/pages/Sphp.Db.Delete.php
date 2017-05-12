<?php

namespace Sphp\Db;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$delete = Apis::sami()->classLinker(Delete::class);

echo $parsedown->text(<<<MD

###SQL database $delete object

The $delete object removes one or more records from a table. A subset may be 
defined for deletion using a condition, otherwise all records are removed. 
	
Some DBMSs, like MySQL, allow to delete rows from multiple tables with one SQL 
DELETE statement.
MD
);
CodeExampleBuilder::visualize("Sphp/Db/delete1.php", true, 'sql');
