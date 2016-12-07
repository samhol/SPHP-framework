<?php

/**
 * EventDispatcherInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\Events;

/**
 * Defines minimum requirements of an Event Dispatcher
 * 
 * Event Dispatcher manages event listeners and dispatching events
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface EventDispatcherInterface {

  /**
   * Adds a new listener to an event
   *
   * @param  string|string[] $event event name(s) of the event(s) the listener listens to
   * @param  EventListenerInterface|\Closure $listener the listener to add 
   * @param mixed $priority optional priority of the listener: priorities are 
   *        handled like queues, and multiple attachments added to the same 
   *        priority queue will be treated in the order of insertion.
   * @return self for PHP Method Chaining
   * @throws \InvalidArgumentException if the `$listener` type is illegal
   * @return self for PHP Method Chaining
   */
  public function addListener($event, $listener, $priority = 0);

  /**
   * Removes an listener from the registry
   *
   * @param  EventListenerInterface|callable $listener the listener to remove
   * @return self for PHP Method Chaining
   */
  public function remove($listener);

  /**
   * Triggers a new event to all corresponding listeners
   *
   * @param    EventInterface $event event object
   * @return   self for PHP Method Chaining
   * @triggers {@link EventInterface} the `$event` passed as parameter 
   */
  public function trigger(EventInterface $event);

  /**
   * Checks whether the given event has listeners
   *
   * @param  EventInterface|string $event event object or the name of the event
   * @return boolean true if event has listeners, false otherwise
   */
  public function hasListeners($event);

  /**
   * Get all listeners for an event
   *
   * @param  EventInterface|string $event event object or the name of the event
   * @return mixed[] containing the listener objects
   */
  public function getListeners($event);
}
