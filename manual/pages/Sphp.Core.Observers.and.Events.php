<?php

namespace Sphp\Stdlib\Events;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$eventInterface = Apis::apigen()->classLinker(EventInterface::class);
$eventClass = Apis::apigen()->classLinker(Event::class);
$eventListenerInterface = Apis::apigen()->classLinker(EventListenerInterface::class);
$eventDispatcherInterface = Apis::apigen()->classLinker(EventDispatcherInterface::class);
echo $parsedown->text(<<<MD
#EVENTS AND OBSERVERS
		
Observer Design pattern and Event dispatching systems are mainly used to implement 
distributed event handling systems they are also key parts in the model–view–controller 
(MVC) architectural pattern.

##EventDispatcing system: 
$ns
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

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

CodeExampleBuilder::visualize("Sphp/Core/Events/EventManager.php", "text", false);

namespace Sphp\Stdlib\Observers;

use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;

Use Sphp\Stdlib\Observers\Observer;
use Sphp\Stdlib\Observers\Subject;

$splObserver = $php->classLinker(Observer::class);
$splSubject = $php->classLinker(Subject::class);
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

CodeExampleBuilder::visualize("Sphp/Core/ObservableSubjectTrait.php", "text", false);

echo $parsedown->text(<<<MD


Observer pattern is in use for example in the SPHP Error handling system introduced 
in the {$api->namespaceLink(\Sphp\Config\ErrorHandling\ErrorExceptionThrower::class)} namespace.

MD
);
