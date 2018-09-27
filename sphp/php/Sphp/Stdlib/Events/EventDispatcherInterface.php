<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Events;

/**
 * Defines minimum requirements of an Event Dispatcher
 * 
 * Event Dispatcher manages event listeners and dispatching events
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface EventDispatcherInterface {

  /**
   * Adds a new listener to an event
   *
   * @param  string $event event name(s) of the event(s) the listener listens to
   * @param  EventListener|\Closure $listener the listener to add 
   * @param  int $priority optional priority of the listener: priorities are 
   *         handled like queues, and multiple attachments added to the same 
   *         priority queue will be treated in the order of insertion.
   * @return $this for a fluent interface
   * @throws \InvalidArgumentException if the `$listener` type is illegal
   * @return $this for a fluent interface
   */
  public function addListener(string $event, $listener, int $priority = 0);

  /**
   * Removes an listener from the registry
   *
   * @param  EventListener|callable $listener the listener to remove
   * @return $this for a fluent interface
   */
  public function remove($listener, string $evantName = null);

  /**
   * Triggers a new event to all corresponding listeners
   *
   * @param    Event $event event object
   * @return   self for PHP Method Chaining
   * @triggers {@link Event} the `$event` passed as parameter 
   */
  public function trigger(Event $event);

  /**
   * Checks whether the given event has listeners
   *
   * @param  Event|string $event event object or the name of the event
   * @return boolean true if event has listeners, false otherwise
   */
  public function hasListeners($event): bool;

  /**
   * Get all listeners for an event
   *
   * @param  Event|string $event event object or the name of the event
   * @return mixed[] containing the listener objects
   */
  public function getListeners($event): array;
}
