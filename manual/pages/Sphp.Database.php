<?php

namespace Sphp\Database;

use Sphp\Manual;

require_once('manual/common/pdo.php');
$pdo = Manual\php()->classLinker(\PDO::class);
$db = Manual\api()->classLinker(DB::class);
Manual\md(<<<MD
#Database manipulation <small>using statement builders</small>

$db manages $pdo database connections and acts as a factory for all SQL statement builder objects.

MD
);

Manual\loadPage('Sphp.Database.example-tables');
Manual\loadPage('Sphp.Database.Insert');
Manual\loadPage('Sphp.Database.Query');
Manual\loadPage('Sphp.Database.Update');
Manual\loadPage('Sphp.Database.Delete');

Manual\md(<<<MD
###References:
        
 * https://phpdelusions.net/pdo 
 * https://www.mysql.com/
MD
);
