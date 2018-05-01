<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime;

/**
 * Description of DateCollection
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DateCollection implements \IteratorAggregate {

  /**
   * @var DateInterface[] 
   */
  private $dates = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->dates = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->dates);
  }

  /**
   * 
   * @param  DateInterface|DateTimeInteface|string|int ...$date
   * @return $this
   */
  public function addDates(... $date) {
    foreach ($date as $d) {
      $this->addDate($d);
    }
    return $this;
  }

  /**
   * 
   * @param  DateInterface|DateTimeInteface|string|int $date
   * @return $this
   */
  public function addDate($date) {
    if (!$date instanceof DateInterface) {
      $date = new Date($date);
    }
    $key = $date->format('Y-m-d');
    if (!array_key_exists($key, $this->dates)) {
      $this->dates[$key] = $date;
    }
    return $this;
  }

  /**
   * Checks if the event collection is empty
   * 
   * @return bool true if the event collection is empty, false otherwise
   */
  public function notEmpty(): bool {
    return !empty($this->dates);
  }

  public function toArray(): array {
    return $this->dates;
  }

  /**
   * Returns the current note
   * 
   * @return mixed the current note
   */
  public function current() {
    return current($this->dates);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->dates);
  }

  /**
   * Return the key of the current date
   * 
   * @return mixed the key of the current date
   */
  public function key() {
    return key($this->dates);
  }

  /**
   * Rewinds the Iterator to the first date
   * 
   * @return void
   */
  public function rewind() {
    reset($this->dates);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->dates);
  }

  /**
   * Create a new iterator to iterate through dates in calendar
   *
   * @return Traversable iterator
   */
  public function getIterator(): \Traversable {   
    ksort($this->dates);
    return new \ArrayIterator($this->dates);
  }

}
