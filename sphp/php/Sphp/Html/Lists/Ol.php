<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use Sphp\Html\Attributes\PatternAttribute;

/**
 * Implements an ordered HTML list
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_ol.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/semantics.html#the-ol-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Ol extends StandardList {

  /**
   * Decimal numbers (1, 2, 3, 4) Default
   */
  public const DECIMAL = '1';

  /**
   * Alphabetically ordered list, lowercase (a, b, c, d)
   */
  public const LOWER_ALPHA = 'a';

  /**
   * Alphabetically ordered list, uppercase (A, B, C, D)
   */
  public const UPPER_ALPHA = 'A';

  /**
   * Roman numbers, lowercase (i, ii, iii, iv)
   */
  public const LOWER_ROMAN = 'i';

  /**
   * Roman numbers, uppercase (I, II, III, IV)
   */
  public const UPPER_ROMAN = 'I';

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('ol');
    $this->attributes()->setInstance(new PatternAttribute('type', '/^[1|a|A|i|I]$/'));
  }

  /**
   * Sets or unsets the list ordering reversed
   * 
   * @param  bool $reversed true if the list ordering is reversed, false otherwise
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_ol_reversed.asp reversed attribute
   */
  public function setReversed(bool $reversed = true) {
    $this->attributes()->setAttribute('reversed', $reversed);
    return $this;
  }

  /**
   * Sets the start value of the list ordering index
   * 
   * **Important:** this indexing is independent from the storing offsets of 
   * the {LiInterface} components in the container
   * 
   * @param  int|null $start the start value of the list ordering index
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_ol_start.asp start attribute
   */
  public function setStart(?int $start) {
    $this->attributes()->setAttribute('start', $start);
    return $this;
  }

  /**
   * Returns the start value of the list ordering index
   * 
   * **Important:** this indexing is independent from the storing offsets of 
   * the {LiInterface} components in the container
   * 
   * @return int the start value of the list ordering index (defaults to 1)
   * @link   https://www.w3schools.com/tags/att_ol_start.asp start attribute
   */
  public function getStart(): int {
    $start = 1;
    if ($this->attributes()->isVisible('start')) {
      $start = $this->attributes()->getValue('start');
    }
    return (int) $start;
  }

  /**
   * Sets the kind of marker used in the list
   * 
   *  * Ol::DECIMAL - `'1'`: Decimal numbers (1, 2, 3, 4) **Default**
   *  * Ol::LOWER_ALPHA - `'a'`: Alphabetically ordered list, lowercase (a, b, c, d)
   *  * Ol::UPPER_ALPHA - `'A'`: Alphabetically ordered list, uppercase (A, B, C, D)
   *  * `'i'`: Roman numbers, lowercase (i, ii, iii, iv)
   *  * `'I'`: Roman numbers, uppercase (I, II, III, IV)
   * 
   * @param  string $type the kind of marker used in the list
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_ol_type.asp type attribute
   */
  public function setListType(?string $type = self::DECIMAL) {
    $this->attributes()->setAttribute('type', $type);
    return $this;
  }

  /**
   * Returns the kind of marker used in the list
   * 
   * @return string the kind of marker used in the list
   * @link   https://www.w3schools.com/tags/att_ol_type.asp type attribute
   */
  public function getListType(): string {
    $type = static::DECIMAL;
    if ($this->attributes()->isVisible('type')) {
      $type = $this->attributes()->getValue('type');
    }
    return $type;
  }

}
