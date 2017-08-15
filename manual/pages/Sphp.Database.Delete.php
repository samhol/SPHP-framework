<?php

namespace Sphp\Database;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$delete = Apis::sami()->classLinker(Delete::class);

echo $parsedown->text(<<<MD

###Deleting records with $delete object

The $delete object removes one or more records from a table. A subset may be 
defined for deletion using a condition, otherwise all records are removed. 
MD
);
CodeExampleBuilder::visualize("Sphp/Database/Delete.php", 'text', false);