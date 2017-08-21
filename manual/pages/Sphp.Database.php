<?php

namespace Sphp\Database;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Html\Apps\Manual\Apis;


require_once('manual/PDO/configuration.php');
$pdo = Apis::phpManual()->classLinker(\PDO::class);
$db =  Apis::sami()->classLinker(DB::class);
\Sphp\Manual\parseDown(<<<MD
#DATABASE MANIPULATION <small>using statement builders</small>

$db manages $pdo database connections and acts as a factory for all SQL statement builder objects.
        
MD
);


$sqlException = Apis::sami()->classLinker(\Exception::class);

//CodeExampleBuilder::visualize('Sphp/Database/DB.Update.php', 'sql', false);
(new SyntaxHighlightingSingleAccordion('Example tables as MySQL'))
        ->loadFromFile('Sphp/Database/tables.sql')
        ->printHtml();

\Sphp\Manual\loadPage('Sphp.Database.Insert');
\Sphp\Manual\loadPage('Sphp.Database.Delete');
\Sphp\Manual\loadPage('Sphp.Database.Query');
\Sphp\Manual\loadPage('Sphp.Database.Update');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Query.php', 'sql');
//CodeExampleBuilder::visualize('Sphp/Database/NamedPDOParameters.php', 'text');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Insert.php', 'text');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Delete.php', 'sql', false);
//CodeExampleBuilder::visualize('Sphp/Database/DB.Update.php', 'sql', false);
