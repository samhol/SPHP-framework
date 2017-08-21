<?php

namespace Sphp\Database;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

use Sphp\Html\Apps\Manual\Apis;

$update = Apis::sami()->classLinker(Update::class);

\Sphp\Manual\parseDown(<<<MD

##Updating records with $update object
		
The $update object executes declarative **UPDATE** statement in SQL databases.

An $update object changes the data of one or more records in a table. Either all 
the rows can be updated, or a subset may be chosen {$update->methodLink('where')}.
MD
);
CodeExampleBuilder::visualize('Sphp/Database/Update.php', 'text', false);
