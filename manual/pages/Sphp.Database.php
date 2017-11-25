<?php

namespace Sphp\Database;

use Sphp\Html\Foundation\Sites\Containers\Accordions\SyntaxHighlightingSingleAccordion;
use Sphp\Manual;

require_once('manual/common/pdo.php');
$pdo = Manual\php()->classLinker(\PDO::class);
$db = Manual\api()->classLinker(DB::class);
Manual\parseDown(<<<MD
#DATABASE MANIPULATION <small>using statement builders</small>

$db manages $pdo database connections and acts as a factory for all SQL statement builder objects.
        
MD
);


//CodeExampleBuilder::visualize('Sphp/Database/DB.Update.php', 'sql', false);
(new SyntaxHighlightingSingleAccordion('Example tables as MySQL'))
        ->loadFromFile('Sphp/Database/tables.sql')
        ->printHtml();

Manual\loadPage('Sphp.Database.Insert');
Manual\loadPage('Sphp.Database.Query');
Manual\loadPage('Sphp.Database.Update');
Manual\loadPage('Sphp.Database.Delete');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Query.php', 'sql');
//CodeExampleBuilder::visualize('Sphp/Database/NamedPDOParameters.php', 'text');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Insert.php', 'text');
//CodeExampleBuilder::visualize('Sphp/Database/DB.Delete.php', 'sql', false);
//CodeExampleBuilder::visualize('Sphp/Database/DB.Update.php', 'sql', false);
