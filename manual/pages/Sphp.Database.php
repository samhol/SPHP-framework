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

//CodeExampleBuilder::visualize('Sphp/Database/DB.Update.php', 'sql', false);
CodeExampleBuilder::visualize('Sphp/Database/Rules.php', 'text');

$load('Sphp.Database.Insert');
$load('Sphp.Database.Delete');
$load('Sphp.Database.Query');
$load('Sphp.Database.Update');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Query.php', 'sql');
//CodeExampleBuilder::visualize('Sphp/Database/NamedPDOParameters.php', 'text');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Insert.php', 'text');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Delete.php', 'sql', false);
//CodeExampleBuilder::visualize('Sphp/Database/DB.Update.php', 'sql', false);
