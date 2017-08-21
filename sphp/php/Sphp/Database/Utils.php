<?php

/**
 * Utils.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Database;

/**
 * Description of Utils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-08-21
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Utils {

  /**
   * 
   * @param int $length
   * @return string
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public static function createGroupOfQuestionMarks(int $length): string {
    //$num = count($data);
    if ($length > 0) {
      $qMarks = array_fill(0, $length, '?');
      return '(' . implode(', ', $qMarks) . ')';
    }
    throw new \Sphp\Exceptions\InvalidArgumentException("An empty grout requested");
  }

}
