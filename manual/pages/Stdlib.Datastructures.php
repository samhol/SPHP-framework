<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Manual;
$php = Manual\php();
//$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
/* $eventInterface = Manual\api()->classLinker(EventInterface::class);
  $eventClass = Manual\api()->classLinker(Event::class);
  $eventListenerInterface = Manual\api()->classLinker(EventListenerInterface::class);
  $eventDispatcherInterface = Manual\api()->classLinker(EventDispatcherInterface::class); */
Manual\parseDown(<<<MD
###[DATA STRUCTURES](Sphp.Stdlib.Datastructures)
The {$php->extensionLink('SPL', 'Standard PHP Library (SPL)')} provides a set of standard data structures for PHP language. SPHP
framework contain a few extensions to these for additional properties.
MD
);
