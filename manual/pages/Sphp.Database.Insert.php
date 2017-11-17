<?php

namespace Sphp\Database;

use Sphp\Manual;

$insert = \Sphp\Manual\api()->classLinker(Insert::class);

Manual\parseDown(<<<MD
##Inserting records <small>with $insert object</small>
		
The $insert object executes declarative INSERT statement in SQL databases.
		
MD
);
Manual\visualize('Sphp/Database/Insert.one.php', 'text', false);
Manual\visualize('Sphp/Database/Insert.php', 'text', false);
