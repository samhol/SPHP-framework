<?php

/**
 * ColumnPropertiesValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids\XY;

use Sphp\Stdlib\Strings;
use Sphp\Html\Foundation\Sites\Core\Screen;

/**
 * Description of ColumnPropertiesValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ColumnUtils {

  protected static function sreenSizes(): string {
    return implode('|', Screen::sizes());
  }

  public static function isValidSize(string $value): bool {
    return Strings::match($value, '/^((' . static::sreenSizes() . ')-([1-9]|1[012])|auto)|auto)+$/');
  }

  public static function isValidOffset(string $value): bool {
    return Strings::match($value, '/^((' . static::sreenSizes() . ')-offset-([1-9]|1[012])))+$/');
  }

  public static function filterValidSizes(array $values): array {
    $widthFilter = function ($value) {
      return static::isValidSize($value);
    };
    return array_filter($values, $widthFilter);
  }

  public static function getAllWidthsFor(string $screenSize = null): array {
    for ($i = 1; $i <= $this->getMaxSize(); $i++) {
      $classes[] = "$screenSize-$i";
    }
    $classes[] = "$screenSize-auto";
    return $classes;
  }

  public static function filterValidOffsets(array $values): array {
    $widthFilter = function ($value) {
      return static::isValidOffset($value);
    };
    return array_filter($values, $widthFilter);
  }

}
