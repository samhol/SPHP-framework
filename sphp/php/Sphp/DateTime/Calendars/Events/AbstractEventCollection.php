<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Events;

use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Events\Exceptions\NoteException;

/**
 * Description of NoteCollection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractEventCollection implements \Iterator, \Sphp\Stdlib\Datastructures\Arrayable {

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

  public function insertNote(Event $note): bool {
    $inserted = false;
    if (!$this->containsNote($note)) {
      $this->collection[] = $note;
      $inserted = true;
    }
    return $inserted;
  }

  /**
   * 
   * @param  CalendarDateInfo $notes
   * @return $this 
   */
  public function mergeNotes(EventCollection $notes) {
    foreach ($notes as $note) {
      $this->insertNote($note);
    }
    return $this;
  }

  public function containsNote(Event $note): bool {
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
   * Checks if the note collection is empty
   * 
   * @return bool true if the collection is not empty and false otherwise
   */
  public function notEmpty(): bool {
    return !empty($this->collection);
  }
  /**
   * Returns all notes stored
   * 
   * @return Holiday[] all holiday notes stored
   */
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
