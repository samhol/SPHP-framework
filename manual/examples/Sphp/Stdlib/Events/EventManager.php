<?php

namespace Sphp\Stdlib\Events;

class OwnListener implements EventListener {

  public function on(Event $event) {
    echo "\n" . Listener::class . " got an event:\n";
    var_dump($event->getData());
  }

}

$fun = function(Event $event) {
  echo "\nClosure fun got an event:\n";
  var_dump($event->getData());
};

$manager = new EventDispatcher();
$manager->addListener("e1", $l = new OwnListener);
$manager->addListener("e1", $fun);
$manager->addListener("e2", $fun);
$manager->trigger(new DataEvent("e1", $manager, "Hello e1 listeners"));
$manager->trigger(new DataEvent("e2", $manager, "Hello e12 listeners"));
