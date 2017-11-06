<?php

namespace Sphp\Database;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$update = \Sphp\Manual\api()->classLinker(Update::class);

\Sphp\Manual\parseDown(<<<MD
##Updating records <small>with $update object</small>
		
The $update object executes declarative **UPDATE** statement in SQL databases.

An $update object changes the data of one or more records in a table. Either all 
the rows can be updated, or a subset may be chosen {$update->methodLink('where')}.
MD
);
CodeExampleBuilder::build('Sphp/Database/Update.php', 'text', false)
        ->setExamplePaneTitle('A Simple UPDATE Query Example')
        ->printHtml();
