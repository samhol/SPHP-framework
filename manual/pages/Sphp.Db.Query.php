<?php

namespace Sphp\Db;

$sqlException = $api->classLinker(SQLException::class);
$conditions = $api->classLinker(Conditions::class);
$query = $api->classLinker(Query::class);
$pdo = $php->classLinker(\PDO::class);

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

$exampleViewer(EXAMPLE_DIR . "Sphp/Db/query1.php", 1, "sql");
