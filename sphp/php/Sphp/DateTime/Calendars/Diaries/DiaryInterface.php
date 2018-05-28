<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries;

use Traversable;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Defines basic featured for a Diary containing calendar log
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface DiaryInterface extends Traversable, Arrayable {

  /**
   * Searches identical events 
   * 
   * @param  LogInterface $log the event to search
   * @return bool true if identical event exists, false otherwise
   */
  public function containsLog(LogInterface $log): bool;

  /**
   * Checks if the note collection is empty
   * 
   * @return bool true if the collection is not empty and false otherwise
   */
  public function notEmpty(): bool;
}
