<?php

/**
 * AbstractLimitValidator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;
use Sphp\I18n\Messages\Message;
/**
 * Description of GreaterThanValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-03-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractLimitValidator extends AbstractValidator {

  const INCLUSIVE_ERROR = '_inclusive_';
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
   * @return self for a fluent interface
   */
  public function setInclusive(bool $inclusive) {
    $this->inclusive = $inclusive;
    return $this;
  }

}
