<?php

namespace Sphp\Core\Events;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

$eventInterface = $api->classLinker(EventInterface::class);
$eventClass = $api->classLinker(Event::class);
$eventListenerInterface = $api->classLinker(EventListenerInterface::class);
$eventDispatcherInterface = $api->classLinker(EventDispatcherInterface::class);
echo $parsedown->text(<<<MD
#EVENTS AND OBSERVERS
		
Observer Design pattern and Event dispatching systems are mainly used to implement 
distributed event handling systems they are also key parts in the model–view–controller 
(MVC) architectural pattern.

##The SPHP EventDispatcing system: {$api->namespaceLink(__NAMESPACE__)} namespace

The SPHP EventDispatcing system consists of three different type of objects. 

1. an object implementing $eventDispatcherInterface
2. a number of $eventListenerInterface objects attached to it
3. $eventInterface objects dispatched by the dispatcher to its listener objects

####The $eventInterface in details

SPHP framework has $eventClass class as its build-in implementation of the $eventInterface. 
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

namespace Sphp\Core;

use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Events/EventManager.php", "text", false);

$splObserver = $php->classLinker(\SplObserver::class);
$splSubject = $php->classLinker(\SplSubject::class);
$observableSubjectTrait = $api->classLinker(ObservableSubjectTrait::class);

echo $parsedown->text(<<<MD
##Observer Design Pattern and The $observableSubjectTrait

Observer pattern is used when there is one-to-many relationship between objects 
such as if one object is modified, its depenedent objects are to be notified 
automatically. Observer pattern is a behavioral pattern.
 
The Standard PHP Library (SPL) contains interfaces $splObserver and $splSubject 
to implement the Observer Design Pattern. The $observableSubjectTrait is a trait 
implementation of $splSubject interface.

MD
);

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/ObservableSubjectTrait.php", "text", false);

echo $parsedown->text(<<<MD


Observer pattern is in use for example in the SPHP Error handling system introduced 
in the {$api->namespaceLink("Sphp\\Util\\ErrorHandling")} namespace.

MD
);
