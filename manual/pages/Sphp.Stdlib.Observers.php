<?php

namespace Sphp\Stdlib\Observers;

use Sphp\Html\Apps\Manual\Apis;
use Sphp\Html\Apps\Syntaxhighlighting\CodeExampleBuilder;
Use Sphp\Stdlib\Observers\Observer;
use Sphp\Stdlib\Observers\Subject;

$observer = \Sphp\Manual\api()->classLinker(Observer::class);
$subject = \Sphp\Manual\api()->classLinker(Subject::class);
$callable = Apis::phpManual()->typeLink('callable');
$observableSubjectTrait = \Sphp\Manual\api()->classLinker(ObservableSubjectTrait::class);

\Sphp\Manual\parseDown(<<<MD
##Observer Design Pattern and The $observableSubjectTrait

Observer pattern is used when there is one-to-many relationship between objects 
such as if one object is modified, its depenedent objects are to be notified 
automatically. Observer pattern is a behavioral pattern.
 
Interfaces $observer and $subject can be used implement the Observer Design Pattern. 
The subject can take any $callable type or an $observer object as its observer. 
The $observableSubjectTrait is a trait implementation of $subject interface.

MD
);

CodeExampleBuilder::visualize('Sphp/Stdlib/ObservableSubjectTrait.php', 'text', false);
