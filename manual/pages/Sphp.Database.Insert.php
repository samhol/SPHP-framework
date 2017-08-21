<?php

namespace Sphp\Database;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
use Sphp\Html\Apps\Manual\Apis;

$insert = Apis::sami()->classLinker(Insert::class);

\Sphp\Manual\parseDown(<<<MD

##SQL database $insert object
		
The $insert object executes declarative INSERT statement in SQL databases.
		
MD
);
CodeExampleBuilder::visualize('Sphp/Database/Insert.php', 'text');
