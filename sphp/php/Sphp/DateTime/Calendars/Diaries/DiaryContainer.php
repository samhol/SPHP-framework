<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

/**
 * Description of DiaryContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DiaryContainer {

  /**
   * @var DiaryInterface[] 
   */
  private $diaries = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->diaries = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->diaries);
  }

  public function insertDiary(DiaryInterface $diary): bool {
    $inserted = false;
    if (!$this->containsDiary($diary)) {
      $this->diaries[] = $diary;
      $inserted = true;
    }
    return $inserted;
  }

  public function containsDiary(DiaryInterface $diary): bool {
    $contains = false;
    foreach ($this->diaries as $n) {
      $contains = $diary == $n;
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  /**
   * 
   * @param  DateInterface|DateTimeInteface|string|int|null $date raw date data
   * @return DiaryDate
   */
  public function getDate($date): DiaryDate {
    $dailyLogs = new DiaryDate($date);
    foreach ($this->diaries as $diary) {
      $logs = $diary->getDate($date);
      $dailyLogs->merge($logs);
    }
    return $dailyLogs;
  }

  /**
   * Checks if the event collection is empty
   * 
   * @return bool true if the event collection is empty, false otherwise
   */
  public function notEmpty(): bool {
    return !empty($this->diaries);
  }

  /**
   * Returns the current note
   * 
   * @return mixed the current note
   */
  public function current() {
    return current($this->diaries);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->diaries);
  }

  /**
   * Return the key of the current note
   * 
   * @return mixed the key of the current note
   */
  public function key() {
    return key($this->diaries);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->diaries);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->diaries);
  }

}
