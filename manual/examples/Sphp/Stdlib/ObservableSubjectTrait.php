<?php

namespace Sphp\Stdlib\Observers;

class Subject1 implements Subject {

  use ObservableSubjectTrait;

  public $message;

  public function say($message) {
    $this->message = $message;
    $this->notify();
  }

}

class Observer1 implements Observer {

  public function update(Subject $subject) {
    echo "Observer1: $subject->message\n";
  }

}

$observer2 = function(Subject $subject) {
  echo "A function can also hear me: $subject->message\n";
};

$subject = new Subject1();
$subject->attach(new Observer1);
$subject->attach($observer2);
$subject->say("hello");
$subject->say("hello again");
