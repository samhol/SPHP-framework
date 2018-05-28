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
 * Defines basic featured for a Diary containing calendar log
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface MutableDiaryInterface extends DiaryInterface {

  /**
   * Inserts a new event instance to the collection
   * 
   * @param  LogInterface $event new event instance
   * @return bool true if the event was inserted, false otherwise
   */
  public function insertLog(LogInterface $event): bool;

  /**
   * Merges events from given collection
   * 
   * @param  DiaryInterface $diary events to merge
   * @return $this for a fluent interface
   */
  public function mergeDiaries(DiaryInterface $diary);

}
