<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Events;

use Sphp\Exceptions\InvalidArgumentException;

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
   * @param  string $eventName event name of the event the listener listens to
   * @param  EventListener|\Closure $listener the listener to add 
   * @param  int $priority optional priority of the listener: priorities are 
   *         handled like queues, and multiple attachments added to the same 
   *         priority queue will be treated in the order of insertion.
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the `$listener` type is illegal
   * @return $this for a fluent interface
   */
  public function addListener(string $eventName, $listener, int $priority = 0);

  /**
   * Removes an listener from the registry
   *
   * @param  EventListener|callable $listener the listener to remove
   * @param  string|null $eventName optional name of the event
   * @return $this for a fluent interface
   */
  public function removeListener($listener, string $eventName = null);

  /**
   * Removes listeners of a specific event name from the registry
   * *
   * @param  string $eventName the name of the event
   * @return $this for a fluent interface
   */
  public function removeListenersOf(string $eventName);

  /**
   * Triggers a new event to all corresponding listeners
   *
   * @param    Event $event event object
   * @return   $this for a fluent interface
   * @triggers {@link Event} the `$event` passed as parameter 
   */
  public function trigger(Event $event);

  /**
   * Checks whether the given event has listeners
   *
   * @param  string $eventName the name of the event
   * @return boolean true if event has listeners, false otherwise
   */
  public function hasListeners(string $eventName): bool;

  /**
   * Get all listeners for an event
   *
   * @param  string $eventName the name of the event
   * @return mixed[] containing the listener objects
   */
  public function getListeners(string $eventName): array;
}
