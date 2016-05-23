<?php

/**
 * EventDispatcher.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\Events;

use Sphp\Data\PrioritizedObjectStorage as PrioritizedObjectStorage;

/**
 * Implements an object for managing event listeners and dispatching events
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * The event listeners as eventname => PrioritizedObjectStorage pairs
   *
   * @var PrioritizedObjectStorage[]
   */
  private $listeners = [];

  /**
   * Returns the globally available instance of event manager
   *
   * @param  EventDispatcher $manager optional event manager instance
   * @return EventDispatcher the global event manager
   */
  public static function instance(EventDispatcher $manager = null) {
    if ($manager instanceof EventDispatcher) {
      self::$globalDispatcher = $manager;
    }
    if (empty(self::$globalDispatcher)) {
      self::$globalDispatcher = new EventDispatcher();
    }
    self::$globalDispatcher->isGlobal = true;
    return self::$globalDispatcher;
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->listeners);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link http://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->listeners = [];
  }

  /**
   * Return the type of the given event
   *
   * @param  EventInterface|string $event event object or the type of the event
   * @return string the name of the event
   */
  protected function getEventName($event) {
    if ($event instanceof EventInterface) {
      return $event->getName();
    } else {
      return $event;
    }
  }

  /**
   * {@inheritdoc}
   */
  public function addListener($event, $listener, $priority = 0, $passParams = false) {
    if (is_array($event)) {
      foreach ($event as $event) {
        $this->addListener($event, $listener, $priority, $passParams);
      }
    } else {
      //
      if (!($listener instanceof EventListenerInterface) && !is_callable($listener)) {
        //var_dump($listener);
        throw new \InvalidArgumentException("Listener type is not recognize as legal.");
      }
      $key = $this->getEventName($event);
      if (!array_key_exists($key, $this->listeners)) {
        $this->listeners[$key] = new PrioritizedObjectStorage();
      }
      $this->listeners[$key]->insert($listener, $priority, $passParams);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function remove($listener, $events = null) {
    if ($events === null) {
      foreach ($this->listeners as $event => $l) {
        $l->remove($listener);
        if ($l->count() == 0) {
          unset($this->listeners[$event]);
        }
      }
    } else if (is_array($events)) {
      foreach ($events as $event) {
        $l->remove($listener, $event);
      }
    } else if (array_key_exists($events, $this->listeners)) {
      $this->listeners[$events]->detach($listener);
      if ($l->count() == 0) {
        unset($this->listeners[$events]);
      }
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function trigger(EventInterface $event) {
    $key = $event->getName();
    if (array_key_exists($key, $this->listeners)) {
      foreach ($this->listeners[$key] as $listener) {
        if ($listener instanceof EventListenerInterface) {
          $listener->on($event);
        } else {
          $listener($event);
        }
      }
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function hasListeners($e) {
    $key = $this->getEventName($e);
    return array_key_exists($key, $this->listeners);
  }

  /**
   * {@inheritdoc}
   */
  public function getListeners($event) {
    $key = $this->getEventName($event);
    if (array_key_exists($key, $this->listeners)) {
      return iterator_to_array($this->listeners[$key]);
    } else {
      return [];
    }
  }

}
