<?php

namespace Sphp\Db;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
use Sphp\Html\Apps\Manual\Apis;

$sqlException = Apis::apigen()->classLinker(SQLException::class);
$conditions = Apis::apigen()->classLinker(Conditions::class);
$query = Apis::apigen()->classLinker(Query::class);
$pdo = Apis::phpManual()->classLinker(\PDO::class);

echo $parsedown->text(<<<MD
##$query object for SQL queries

The $query object executes declarative SELECT queries in SQL databases. It 
retrieves data from one or more SQL tables, or expressions and it
has no persistent effects on the database.

Some essential $query methods:
        
* {$query->methodLink("get")} - sets the list of columns to include in the final result
* {$query->methodLink("from")} - indicates the table(s)
* {$query->methodLink("where")} - restricts the rows returned
* {$query->methodLink("groupBy")} - projects rows having common values into a smaller set of rows
* {$query->methodLink("having")} - filters rows resulting from the {$query->methodLink("groupBy")} call
* {$query->methodLink("orderBy")} - sorts the resulting data

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Db/query1.php", 1, "sql");
