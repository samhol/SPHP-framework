<?php

namespace Sphp\Database;

use Sphp\Manual;

$query = Manual\api()->classLinker(Query::class);

Manual\parseDown(<<<MD
##Quering data <small>with $query object</small>

The $query object executes declarative SELECT queries in SQL databases. It 
retrieves data from one or more SQL tables, or expressions and it
has no persistent effects on the database.

Some essential $query methods:
        
* {$query->methodLink('get')} - sets the list of columns to include in the final result
* {$query->methodLink('from')} - indicates the table(s)
* {$query->methodLink('where')} - restricts the rows returned
* {$query->methodLink('groupBy')} - projects rows having common values into a smaller set of rows
* {$query->methodLink('having')} - filters rows resulting from the {$query->methodLink('groupBy')} call
* {$query->methodLink('orderBy')} - sorts the resulting data

MD
);

Manual\example('Sphp/Database/Query.php', 'text', false)
        ->setExamplePaneTitle('A Simple QUERY Example')
        ->printHtml();
