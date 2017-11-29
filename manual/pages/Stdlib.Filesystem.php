<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$parser = Manual\api()->classLinker(Parser::class);
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
$fileSystem = Manual\api()->classLinker(Filesystem::class);
/* $eventInterface = Manual\api()->classLinker(EventInterface::class);
  $eventClass = Manual\api()->classLinker(Event::class);
  $eventListenerInterface = Manual\api()->classLinker(EventListenerInterface::class);
  $eventDispatcherInterface = Manual\api()->classLinker(EventDispatcherInterface::class); */
Manual\parseDown(<<<MD
####WORKING WITH FILES
 * $parser instance can handle file related (reading and writing) operations.
 * $fileSystem: This utility class can handle several local file system related operations.
MD
);
