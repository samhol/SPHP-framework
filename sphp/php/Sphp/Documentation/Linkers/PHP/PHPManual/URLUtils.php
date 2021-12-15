<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual;

/**
 * Class URLUtils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class URLUtils {

  public static function parseMagicName(string $constant): string {
    return str_replace(['__', '_'], ['', '-'], strtolower($constant));
  }

  public static function parseName(string $constant): string {
    return str_replace('_', '-', strtolower($constant));
  }

  public static function parseClassName(string $class): string {
    return str_replace('\\', '-', strtolower($class));
  }

  public static function parseFunctionName(string $method): string {
    return str_replace(['\\', '__', '_'], ['-', '', '-'], strtolower(trim($method, '\\')));
  }

}
