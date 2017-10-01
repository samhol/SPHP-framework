<?php

/**
 * ClassAttributeFilter.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Filters;

use Sphp\Filters\AbstractFilter;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Attributes\MultiValueAttribute;

/**
 * Description of ClassAttributeFilter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-30
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ClassAttributeFilter extends AbstractFilter {

  private static $instance;

  /**
   * Returns an array of unique values parsed from the input
   *
   * **Important:** Parameter <var>$raw</var> restrictions and rules
   * 
   * 1. A string parameter can contain multiple comma separated unique values
   * 2. An array parameter can contain only one unique atomic value per value
   * 3. Duplicate values are ignored
   *
   * @param  mixed $raw the value(s) to parse
   * @return string[] separated atomic values in an array
   */
  public function filter($raw): array {
    $parsed = [];
    if (is_array($raw)) {
      $parsed = $this->filterArray($raw);
    } else if ($raw instanceof MultiValueAttribute) {
      $parsed = $this->filterArray($raw->toArray());
    } else {
      $parsed = $this->splitString(Strings::toString($raw));
    }
    return array_unique($parsed);
  }

  /**
   * 
   * @param  array $raw
   * @return string[]
   */
  public function filterArray(array $raw): array {
    $flatten = Arrays::flatten($raw);
    $result = [];
    foreach ($flatten as $rawValue) {
      $result = array_merge($result, $this->splitString(Strings::toString($rawValue)));
    }
    return $result;
  }

  /**
   * 
   * @param  string $string
   * @return array
   */
  public function splitString(string $string): array {
    $splitted = preg_split("/[\s]+/", trim($string));
    $f = function ($var) {
      return $var !== '';
    };
    $result = array_filter($splitted, $f);
    return $result;
  }

  public static function instance(): ClassAttributeFilter {
    if (static::$instance === null) {
      static::$instance = new static();
    }
    return static::$instance;
  }

}
