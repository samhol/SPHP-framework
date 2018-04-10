<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use Sphp\I18n\Messages\Message;

/**
 * Validates data against certain limit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractLimitValidator extends AbstractValidator {

  /**
   * `ID` for error message describing values not matching an inclusive limit
   */
  const INCLUSIVE_ERROR = '_inclusive_';

  /**
   * `ID` for error message describing values not matching an exclusive limit
   */
  const EXCLUSIVE_ERROR = '_exclusive_';

  /**
   * Whether to do inclusive comparisons, allowing equivalence to max
   *
   * If false, then strict comparisons are done, and the value may equal
   * the min option
   *
   * @var boolean
   */
  private $inclusive;

  /**
   * Constructs a new validator
   * 
   * @param boolean $inclusive true for inclusive limit and false for exclusive
   */
  public function __construct(bool $inclusive = true) {
    parent::__construct();
    $this->setInclusive($inclusive);
    $this->setMessageTemplate(static::EXCLUSIVE_ERROR, Message::singular('Not in range (%s-%s)'));
    $this->setMessageTemplate(static::INCLUSIVE_ERROR, Message::singular('Not in inclusive range (%s-%s)'));
  }

  /**
   * Checks whether the the limit is set as inclusive or not
   * 
   * @return boolean true for inclusive limit and false for not
   */
  public function isInclusive(): bool {
    return $this->inclusive;
  }

  /**
   * Sets whether the the limit is inclusive or not
   * 
   * @param boolean $inclusive true for inclusive limit and false for exclusive
   * @return $this for a fluent interface
   */
  public function setInclusive(bool $inclusive) {
    $this->inclusive = $inclusive;
    return $this;
  }

}
