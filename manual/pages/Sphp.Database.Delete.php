<?php

namespace Sphp\Database;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleAccordionBuilder;
use Sphp\Html\Apps\Manual\Apis;

$delete = \Sphp\Manual\api()->classLinker(Delete::class);

\Sphp\Manual\parseDown(<<<MD
###Deleting records <small>with $delete object</small>

The $delete object removes one or more records from a table. A subset may be 
defined for deletion using a condition, otherwise all records are removed. 
MD
);
CodeExampleAccordionBuilder::build("Sphp/Database/Delete.php", 'text', false)
        ->setExamplePaneTitle('A Simple DELETE Query Example')
        ->printHtml();
