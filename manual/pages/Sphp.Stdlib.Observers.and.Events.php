<?php

namespace Sphp\Stdlib\Events;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$ns = Apis::sami()->namespaceBreadGrumbs(__NAMESPACE__);
$eventInterface = Apis::sami()->classLinker(EventInterface::class);
$eventClass = Apis::sami()->classLinker(Event::class);
$eventListenerInterface = Apis::sami()->classLinker(EventListenerInterface::class);
$eventDispatcherInterface = Apis::sami()->classLinker(EventDispatcherInterface::class);
echo $parsedown->text(<<<MD
#EVENTS AND OBSERVERS
		
Event dispatching systems and Observer Design pattern are often used to implement 
distributed event handling systems they are also key parts in the model–view–controller 
(MVC) architectural pattern.

##EventDispatcing system: 
$ns
The SPHP EventDispatcing system consists of three different type of objects. 

1. an object implementing $eventDispatcherInterface
2. a number of $eventListenerInterface objects attached to it
3. $eventInterface objects dispatched by the dispatcher to its listener objects

####The $eventInterface in details

$eventClass class is a build-in instantiable implementation of the $eventInterface. 
An $eventClass is identified by a inmutable unique name, 
which any number of $eventListenerInterface might be listening to. An $eventInterface instance 
is  passed to all of the listeners. The Event object itself often contains data about the event being dispatched.

####Event Naming Conventions

The unique event name can be any string, but optionally follows a few simple naming conventions:

* only lowercase letters, numbers, dots (.), and underscores (_);
* prefix names with a namespace followed by a dot (e.g. kernel.);
* end names with a verb that indicates what action is being taken (e.g. request).
		
Here are some examples of good event names:

`html.attributes.id.change`
`html.attributes.id.change`

MD
);

CodeExampleBuilder::visualize('Sphp/Stdlib/Events/EventManager.php', 'text', false);

$load('Sphp.Stdlib.Observers');
