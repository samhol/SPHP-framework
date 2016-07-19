<?php

namespace Sphp\Core\Events;

class Listener implements EventListenerInterface {

	public function on(EventInterface $event) {
		echo "\n" . Listener::class . " got an event:\n";
		var_dump($event->getData());
	}

}

$fun = function(EventInterface $event) {
	echo "\nClosure fun got an event:\n";
	var_dump($event->getData());
};

$manager = new EventDispatcher();
$manager->addListener("e1", $l = new Listener);
$manager->addListener("e1", $fun);
$manager->addListener("e2", $fun);
$manager->trigger(new Event("e1", $manager, "Hello e1 listeners"));
$manager->trigger(new Event("e2", $manager, "Hello e12 listeners"));
