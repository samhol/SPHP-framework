<?php

/**
 * TrimFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Filters;

use Sphp\Core\Types\Strings;

/**
 * Filter strips whitespace (or other characters) from the beginning and end of the string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class StringTrimmer extends AbstractFilter {

  /**
   * the string in UTF-8 format
   *
   * @var string 
   */
  private $charmask;

  /**
   * usage of left trimming
   *
   * @var boolean 
   */
  private $left = true;

  /**
   * usage of right trimming
   *
   * @var boolean 
   */
  private $right = true;

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
  public function __construct($charmask = null, $left = true, $right = true) {
    $this->charmask = $charmask;
    $this->left = $left;
    $this->right = $right;
  }

  /**
   * Executes the filter for the given value
   * 
   * @param  mixed $string the value to filter
   * @return mixed the filtered value
   */
  public function filter($string) {
    if (!is_string($string) || (!$this->left && !$this->right)) {
      return $string;
    }
    if ($this->left && $this->right) {
      $string = Strings::trim($string, $this->charmask);
    } else if ($this->left) {
      $string = Strings::trimLeft($string, $this->charmask);
    } else if ($this->right) {
      $string = Strings::trimRight($string, $this->charmask);
    }
    return $string;
  }

  /**
   * 
   * @param  string $charmask
   * @return self new instance that does left trimming
   */
  public static function leftTrimmer($charmask) {
    return new static($charmask, true, false);
  }

  /**
   * 
   * @param  string $charmask
   * @return self new instance that does right trimming
   */
  public static function rightTrimmer($charmask) {
    return new static($charmask, false, true);
  }

}
