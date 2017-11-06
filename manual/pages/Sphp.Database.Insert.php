<?php

namespace Sphp\Database;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$insert = \Sphp\Manual\api()->classLinker(Insert::class);

\Sphp\Manual\parseDown(<<<MD
##Inserting records <small>with $insert object</small>
		
The $insert object executes declarative INSERT statement in SQL databases.
		
MD
);
CodeExampleBuilder::visualize('Sphp/Database/Insert.one.php', 'text', false);
CodeExampleBuilder::visualize('Sphp/Database/Insert.php', 'text', false);
