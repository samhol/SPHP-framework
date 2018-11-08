<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Validators;

use DateTime;

/**
 * Validates a datetime
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DatetimeFormat extends AbstractValidator {

  /**
   * the required format of the validable value
   *
   * @var string
   */
  private $format = 'Y-m-d H:i:s';

  /**
   * Constructs a new validator
   *
   * @param string $format the required format of the validable value
   */
  public function __construct(string $format = 'Y-m-d H:i:s') {
    parent::__construct('Please insert correct date and time');
    $this->setDateTimeFormat($format);
  }

  /**
   * Sets the required format of the validable value
   *
   * @param  string $format the required format of the validable value
   * @return $this for a fluent interface
   */
  public function setDateTimeFormat(string $format) {
    $this->format = $format;
    return $this;
  }

  public function isValid($value): bool {
    $this->setValue($value);
    if (!is_string($value)) {
      $this->errors()->appendErrorFromTemplate(static::INVALID);
      return false;
    }
    $obj = DateTime::createFromFormat($this->format, $value);
    //echo $obj->format('Y-m-d H:i:s');
    if ($obj == false || DateTime::getLastErrors()['warning_count'] != 0 || DateTime::getLastErrors()['error_count'] != 0) {
      $this->errors()->appendErrorFromTemplate(static::INVALID);
      return false;
    }
    return true;
  }

}
