<?php

/**
 * RightTrimFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Types\Filters;

use Sphp\Core\Types\Strings as Strings;

/**
 * Filter strips whitespace (or other characters) from the end of the string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class RightTrimFilter extends AbstractStringFilter {

  /**
   * the string in UTF-8 format
   *
   * @var string 
   */
  private $charmask;

  /**
   * Constructs a new instance
   * 
   * Without the $charmask parameter these characters will be stripped:
   * 
   * * " " (ASCII 32 (0x20)), an ordinary space.
   * * "\t" (ASCII 9 (0x09)), a tab.
   * * "\n" (ASCII 10 (0x0A)), a new line (line feed).
   * * "\r" (ASCII 13 (0x0D)), a carriage return.
   * * "\0" (ASCII 0 (0x00)), the NUL-byte.
   * * "\x0B" (ASCII 11 (0x0B)), a vertical tab.
   * 
   * @param  null|string $charmask characters to be stripped
   */
  public function __construct($charmask = null) {
    $this->charmask = $charmask;
    parent::__construct();
  }

  /**
   * Executes the filter for the given value
   * 
   * @param  mixed $string the value to filter
   * @return mixed the filtered value
   */
  protected function runFilter($string) {
    if ($this->charmask !== null) {
      $result = Strings::trimRight($string, $this->charmask);
    } else {
      $result = rtrim($string);
    }
    return $result;
  }

}
