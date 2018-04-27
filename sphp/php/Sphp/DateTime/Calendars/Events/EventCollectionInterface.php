<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Traversable;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Defines EventNoteCollectionInterface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-04-27
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface EventCollectionInterface extends Traversable, Arrayable {

  /**
   * Inserts a new event instance to the collection
   * 
   * @param  Event $event new event instance
   * @return bool true if the event was inserted, false otherwise
   */
  public function insertEvent(Event $event): bool;

  /**
   * Merges event from given collection
   * 
   * @param  CalendarDateInfo $events events to merge
   * @return $this for a fluent interface
   */
  public function mergeEvents(EventCollectionInterface $events);

  public function containsEvent(Event $note): bool;

  /**
   * Returns all birthday notes stored
   * 
   * @return BirthDay[] all birthday notes stored
   */
  public function getBirthdays(): array;

  /**
   * Checks if the note collection is empty
   * 
   * @return bool true if the collection is not empty and false otherwise
   */
  public function notEmpty(): bool;
}
