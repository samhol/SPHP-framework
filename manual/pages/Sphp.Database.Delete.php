<?php

namespace Sphp\Database;

$delete = \Sphp\Manual\api()->classLinker(Delete::class);

\Sphp\Manual\md(<<<MD
###Deleting records <small>with $delete object</small>

The $delete object removes one or more records from a table. A subset may be 
defined for deletion using a condition, otherwise all records are removed. 
MD
);
\Sphp\Manual\example("Sphp/Database/Delete.php", 'text', false)
        ->setExamplePaneTitle('A Simple DELETE Query Example')
        ->printHtml();
