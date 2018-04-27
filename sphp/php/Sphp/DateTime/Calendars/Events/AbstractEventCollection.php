<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Iterator;

/**
 * Description of NoteCollection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractEventCollection implements Iterator, EventCollectionInterface {

  /**
   * @var Note[] 
   */
  private $collection = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->collection = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->collection);
  }

  public function insertEvent(Event $event): bool {
    $inserted = false;
    if (!$this->containsEvent($event)) {
      $this->collection[] = $event;
      $inserted = true;
    }
    return $inserted;
  }

  /**
   * 
   * @param  EventCollectionInterface $events
   * @return $this
   */
  public function mergeEvents(EventCollectionInterface $events) {
    foreach ($events as $note) {
      $this->insertEvent($note);
    }
    return $this;
  }

  public function containsEvent(Event $note): bool {
    $contains = false;
    foreach ($this->collection as $n) {
      $contains = $note == $n;
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  /**
   * Returns all birthday notes stored
   * 
   * @return BirthDay[] all birthday notes stored
   */
  public function getBirthdays(): array {
    return array_filter($this->collection, function ($item) {
      return $item instanceof BirthDay;
    });
  }


  /**
   * Returns all holidays stored
   * 
   * @return Holiday[] all holiday notes stored
   */
  public function getHolidays(): array {
    return array_filter($this->collection, function ($item) {
      return $item instanceof HolidayInterface;
    });
  }
  
  public function notEmpty(): bool {
    return !empty($this->collection);
  }

  public function toArray(): array {
    return $this->collection;
  }

  /**
   * Returns the current note
   * 
   * @return mixed the current note
   */
  public function current() {
    return current($this->collection);
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    next($this->collection);
  }

  /**
   * Return the key of the current note
   * 
   * @return mixed the key of the current note
   */
  public function key() {
    return key($this->collection);
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    reset($this->collection);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->collection);
  }

}
