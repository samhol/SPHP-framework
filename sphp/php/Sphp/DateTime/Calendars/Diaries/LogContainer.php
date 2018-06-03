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
 * Defines LogContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface LogContainer extends Traversable, Arrayable {

  /**
   * Inserts a new log object to the container
   * 
   * @param  LogInterface $log log object to insert
   * @return bool true if the log is inserted and false otherwise
   */
  public function insertLog(LogInterface $log): bool;

  /**
   * Merges logs from another log container
   * 
   * @param  LogContainer $logs logs to merge
   * @return $this for a fluent interface
   */
  public function mergeLogs(LogContainer $logs);

  /**
   * Searches identical events 
   * 
   * @param  LogInterface $log the event to search
   * @return bool true if identical event exists, false otherwise
   */
  public function logExists(LogInterface $log): bool;

  /**
   * Checks if the note collection is empty
   * 
   * @return bool true if the collection is not empty and false otherwise
   */
  public function notEmpty(): bool;
}
