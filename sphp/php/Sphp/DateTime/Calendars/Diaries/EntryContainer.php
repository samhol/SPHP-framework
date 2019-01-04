<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Sphp\Stdlib\Datastructures\Arrayable;
use Traversable;

/**
 * Defines basic features of a Diary log container 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface EntryContainer extends Traversable, Arrayable, \Countable {

  /**
   * Inserts a new log object to the container
   * 
   * @param  LogInterface $log log object to insert
   * @return bool true if the log is inserted and false otherwise
   */
  public function insertLog(CalendarEntry $log): bool;

  /**
   * Merges logs from another log container
   * 
   * @param  LogContainer $logs logs to merge
   * @return $this for a fluent interface
   */
  public function merge(EntryContainer $logs);

  /**
   * Checks whether given log instance exists
   * 
   * @param  LogInterface $log the log instance to search
   * @return bool true if given log instance exists, false otherwise
   */
  public function logExists(CalendarEntry $log): bool;

  /**
   * Checks if the collection is empty or not
   * 
   * @return bool true if the collection is not empty and false otherwise
   */
  public function notEmpty(): bool;
}
