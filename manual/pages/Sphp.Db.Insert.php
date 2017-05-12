<?php

namespace Sphp\Db;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$sqlException = Apis::sami()->classLinker(SQLException::class);
$insert = Apis::sami()->classLinker(Insert::class);

echo $parsedown->text(<<<MD

##SQL database $insert object
		
The $insert object executes declarative INSERT statement in SQL databases.
		
The number of columns and values must be the same. If a column is not specified, 
the default value for the column is used. The values specified (or implied) by 
the INSERT statement must satisfy all the applicable constraints (such as primary 
keys, CHECK constraints, and NOT NULL constraints). If a syntax error occurs or 
if any constraints are violated, the new row is not added to the table and a 
$sqlException returned instead.
MD
);
CodeExampleBuilder::visualize("Sphp/Db/insert1.php", true, "sql");
