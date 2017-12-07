<?php

namespace Sphp\Stdlib\Observers;

use Sphp\Manual;
Use Sphp\Stdlib\Observers\Observer;
use Sphp\Stdlib\Observers\Subject;

$observer = Manual\api()->classLinker(Observer::class);
$subject = Manual\api()->classLinker(Subject::class);
$callable = Manual\php()->typeLink('callable');
$observableSubjectTrait = Manual\api()->classLinker(ObservableSubjectTrait::class);

Manual\md(<<<MD
##Observer Design Pattern and The $observableSubjectTrait

Observer pattern is used when there is one-to-many relationship between objects 
such as if one object is modified, its depenedent objects are to be notified 
automatically. Observer pattern is a behavioral pattern.
 
Interfaces $observer and $subject can be used implement the Observer Design Pattern. 
The subject can take any $callable type or an $observer object as its observer. 
The $observableSubjectTrait is a trait implementation of $subject interface.

MD
);

Manual\visualize('Sphp/Stdlib/ObservableSubjectTrait.php', 'text', false);
