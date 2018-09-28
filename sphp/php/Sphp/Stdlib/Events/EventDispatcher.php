<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Events;

use Sphp\Stdlib\Datastructures\UniquePriorityQueue;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Implements an event dispatcher
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class EventDispatcher implements EventDispatcherInterface {

  /**
   * Global event dispatcher 
   *
   * @var EventDispatcher
   */
  private static $globalDispatcher = null;

  /**
   * The event listeners as event name => PrioritizedObjectStorage pairs
   *
   * @var UniquePriorityQueue[]
   */
  private $listeners = [];

  /**
   * Returns the globally available instance of event manager
   *
   * @return EventDispatcher the global event manager
   */
  public static function instance(): EventDispatcher {
    if (self::$globalDispatcher === null) {
      self::$globalDispatcher = new EventDispatcher();
    }
    return self::$globalDispatcher;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->listeners);
  }

  public function addListener(string $eventName, $listener, int $priority = 0) {
    if (!($listener instanceof EventListener) && !is_callable($listener)) {
      throw new InvalidArgumentException("Listener type is not recognize as legal");
    }
    if (!array_key_exists($eventName, $this->listeners)) {
      $this->listeners[$eventName] = new UniquePriorityQueue();
    }
    $this->listeners[$eventName]->enqueue($listener, $priority);
    return $this;
  }

  public function removeListenersOf(string $eventName) {
    if (array_key_exists($eventName, $this->listeners)) {
      unset($this->listeners[$eventName]);
    }
    //print_r($this->listeners);
    return $this;
  }

  public function removeListener($listener, string $eventName = null) {
    if ($eventName === null) {
      foreach ($this->listeners as $event => $l) {
        $l->remove($listener);
        if ($l->count() == 0) {
          unset($this->listeners[$event]);
        }
      }
    } else if (array_key_exists($eventName, $this->listeners)) {
      $this->listeners[$eventName]->remove($listener);
      if ($this->listeners[$eventName]->count() == 0) {
        unset($this->listeners[$eventName]);
      }
    }
    //print_r($this->listeners);
    return $this;
  }

  /**
   * Creates and triggers a new event to all corresponding listeners
   * 
   * @param  string $eventName the name of the event
   * @param  mixed $subject subject the subject which dispatched this event
   * @param  mixed $data the data dispatched with this event
   * @return $this for a fluent interface
   */
  public function triggerDataEvent(string $eventName, $subject = null, $data = null): DataEvent {
    $event = new DataEvent($eventName, $subject, $data);
    $this->trigger($event);
    return $event;
  }

  public function trigger(Event $event) {
    $key = $event->getName();
    if (array_key_exists($key, $this->listeners)) {
      foreach ($this->listeners[$key] as $listener) {
        if ($event->isStopped()) {
          break;
        }
        if ($listener instanceof EventListener) {
          $listener->on($event);
        } else {
          $listener($event);
        }
      }
    }
    return $this;
  }

  public function hasListeners(string $eventName): bool {
    return array_key_exists($eventName, $this->listeners);
  }

  public function getListeners(string $eventName): array {
    if (array_key_exists($eventName, $this->listeners)) {
      return $this->listeners[$eventName]->toArray();
    } else {
      return [];
    }
  }

}
