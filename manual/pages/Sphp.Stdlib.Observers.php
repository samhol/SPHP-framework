<?php

namespace Sphp\Stdlib\Observers;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Foundation\Sites\Containers\Accordions\CodeExampleAccordion;
Use Sphp\Stdlib\Observers\Observer;
use Sphp\Stdlib\Observers\Subject;

CodeExampleAccordion::visualize(EXAMPLE_DIR . "Sphp/Core/Events/EventManager.php", "text", false);


$splObserver = Apis::phpManual()->classLinker(Observer::class);
$splSubject = Apis::phpManual()->classLinker(Subject::class);
$observableSubjectTrait = Apis::apigen()->classLinker(ObservableSubjectTrait::class);

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

namespace Sphp\Core\Config\ErrorHandling;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$exceptionHandler = Apis::apigen()->namespaceLink(ExceptionHandler::class);

echo $parsedown->text(<<<MD


Observer pattern is in use for example in the $exceptionHandler class introduced 
in the {$api->namespaceLink(\Sphp\Core\Config\ErrorHandling\ErrorExceptionThrower::class)} namespace.

MD
);
