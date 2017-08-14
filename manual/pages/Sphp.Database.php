<?php

namespace Sphp\Database;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;
require_once('manual/PDO/configuration.php');
$query = $api->classLinker(Query::class);
$pdo = Apis::phpManual()->classLinker(\PDO::class);

echo $parsedown->text(<<<MD
##The $query class

MD
);


$sqlException = Apis::sami()->classLinker(\Exception::class);
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
CodeExampleBuilder::visualize('Sphp/Database/DB.Insert.php', 'text');
CodeExampleBuilder::visualize('Sphp/Database/DB.Update.php', 'sql', false);
CodeExampleBuilder::visualize('Sphp/Database/Rules.php', 'text');

$load('Sphp.Database.Query');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Query.php', 'sql');
//CodeExampleBuilder::visualize('Sphp/Database/NamedPDOParameters.php', 'text');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Insert.php', 'text');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Delete.php', 'sql', false);
//CodeExampleBuilder::visualize('Sphp/Database/DB.Update.php', 'sql', false);
