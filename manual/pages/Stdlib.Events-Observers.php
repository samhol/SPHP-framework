<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$stdlibNs = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);
/*$eventInterface = Manual\api()->classLinker(EventInterface::class);
$eventClass = Manual\api()->classLinker(Event::class);
$eventListenerInterface = Manual\api()->classLinker(EventListenerInterface::class);
$eventDispatcherInterface = Manual\api()->classLinker(EventDispatcherInterface::class);*/
Manual\parseDown(<<<MD
#EVENTS AND OBSERVERS
$stdlibNs		
Event dispatching systems and Observer Design pattern are often used to implement 
distributed event handling systems. They are also key parts in the model–view–controller 
(MVC) architectural pattern.

MD
);
