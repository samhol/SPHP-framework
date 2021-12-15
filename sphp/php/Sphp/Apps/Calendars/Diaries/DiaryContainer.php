<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries;

use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\DateTime\Date;

/**
 * Description of DiaryContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DiaryContainer implements Countable, IteratorAggregate, Arrayable {

  /**
   * @var Diary[] 
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

  public function insertDiary(Diary $diary): bool {
    $inserted = false;
    if (!$this->containsDiary($diary)) {
      $this->diaries[] = $diary;
      $inserted = true;
    }
    return $inserted;
  }

  public function containsDiary(Diary $diary): bool {
    return in_array($diary, $this->diaries, true);
  }

  /**
   * 
   * @param  Date $date raw date data
   * @return DiaryDate
   */
  public function getDate(Date $date): DiaryDate {
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

  public function count(): int {
    return count($this->diaries);
  }

  public function getIterator(): Traversable {
    return new ArrayIterator($this->diaries);
  }

  public function toArray(): array {
    return $this->diaries;
  }

}
