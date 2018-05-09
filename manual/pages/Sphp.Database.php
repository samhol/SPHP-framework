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

Manual\printPage('Sphp.Database.example-tables');
Manual\printPage('Sphp.Database.Insert');
Manual\printPage('Sphp.Database.Query');
Manual\printPage('Sphp.Database.Update');
Manual\printPage('Sphp.Database.Delete');

Manual\md(<<<MD
###References:
        
 * https://phpdelusions.net/pdo 
 * https://www.mysql.com/
MD
);
