<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Database;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of Utils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
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
