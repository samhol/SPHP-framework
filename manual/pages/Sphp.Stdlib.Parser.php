<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$arrLink = Manual\php()->typeLink('array');
$parser = Manual\api()->classLinker(Parser::class);
Manual\md(<<<MD
##PARSING FILETYPES: <small>reading, writing and transforming</small>

$parser instance can handle file related (reading and writing) operations.
MD
);

Manual\visualize('Sphp/Filesystem/FileObject1.php', 'text', false);
