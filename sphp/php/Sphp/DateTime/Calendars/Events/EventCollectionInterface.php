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
 * Defines basic featured for a Calendar Event collection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
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
   * Merges events from given collection
   * 
   * @param  EventCollectionInterface $events events to merge
   * @return $this for a fluent interface
   */
  public function mergeEvents(EventCollectionInterface $events);

  /**
   * Searches identical events 
   * 
   * @param  Event $event the event to search
   * @return bool true if identical event exists, false otherwise
   */
  public function containsEvent(Event $event): bool;

  /**
   * Checks if the note collection is empty
   * 
   * @return bool true if the collection is not empty and false otherwise
   */
  public function notEmpty(): bool;

  /**
   * Returns all birthday notes stored
   * 
   * @return BirthDay[] all birthday notes stored
   */
  public function getBirthdays(): array;

  /**
   * Returns all holidays stored
   * 
   * @return Holiday[] all holiday notes stored
   */
  public function getHolidays(): array;

  /**
   * Returns all note type notes stored
   * 
   * @return Note[] all note type notes stored
   */
  public function getNotes(): array;
}
