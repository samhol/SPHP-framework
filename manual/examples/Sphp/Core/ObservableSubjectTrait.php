<?php

namespace Sphp\Core;

class Subject implements \SplSubject {

	use ObservableSubjectTrait;

	public $message;

	public function say($message) {
		$this->message = $message;
		$this->notify();
	}

}

class Observer1 implements \SplObserver {

	public function update(\SplSubject $subject) {
		echo "Observer1: $subject->message\n";
	}

}

class Observer2 implements \SplObserver {

	public function update(\SplSubject $subject) {
		echo "Observer2: $subject->message\n";
	}

}

$subject = new Subject();
$subject->attach(new Observer1);
$subject->attach(new Observer2);
$subject->say("hello");
$subject->say("hello again");
