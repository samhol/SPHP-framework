<?php

/**
 * Utils.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;
use Sphp\Exceptions\InvalidArgumentException;
/**
 * Description of Utils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Utils {

  /**
   * Creates a group of question marks demerged by commas
   * 
   * @param  int $length number of questionmarks greated
   * @return string created questionmark string
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public static function createGroupOfQuestionMarks(int $length): string {
    //$num = count($data);
    if ($length > 0) {
      $qMarks = array_fill(0, $length, '?');
      return '(' . implode(', ', $qMarks) . ')';
    }
    throw new InvalidArgumentException('An empty grout requested');
  }

}
