<?php

namespace Sphp\Stdlib\Observers;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
Use Sphp\Stdlib\Observers\Observer;
use Sphp\Stdlib\Observers\Subject;

$observer = Apis::apigen()->classLinker(Observer::class);
$subject = Apis::apigen()->classLinker(Subject::class);
$callable = Apis::phpManual()->typeLink('callable');
$observableSubjectTrait = Apis::apigen()->classLinker(ObservableSubjectTrait::class);

echo $parsedown->text(<<<MD
##Observer Design Pattern and The $observableSubjectTrait

Observer pattern is used when there is one-to-many relationship between objects 
such as if one object is modified, its depenedent objects are to be notified 
automatically. Observer pattern is a behavioral pattern.
 
Interfaces $observer and $subject can be used implement the Observer Design Pattern. The subject can take any $callable type or an $observer object as its observer. The $observableSubjectTrait is a trait 
implementation of $subject interface.

MD
);

CodeExampleBuilder::visualize("Sphp/Core/ObservableSubjectTrait.php", "text", false);

namespace Sphp\Config\ErrorHandling;

use Sphp\Html\Apps\Manual\Apis;

$ns = Apis::apigen()->namespaceBreadGrumbs(__NAMESPACE__);
$exceptionHandler = Apis::apigen()->classLinker(ExceptionHandler::class);

echo $parsedown->text(<<<MD


Observer pattern is in use for example in the $exceptionHandler class introduced 
in the {$api->namespaceLink(__NAMESPACE__)} namespace.

MD
);
