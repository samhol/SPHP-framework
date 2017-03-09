<?php

/**
 * DatetimeValidator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use DateTime;

/**
 * Validates a datetime
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-26-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DatetimeValidator extends AbstractValidator {

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
  public function __construct($format = 'Y-m-d H:i:s') {
    parent::__construct();
    if ($format !== null) {
      $this->setDateTimeFormat($format);
    }
  }

  /**
   * Sets the required format of the validable value
   *
   * @param string $format the required format of the validable value
   * @return self for a fluent interface
   */
  public function setDateTimeFormat($format) {
    $this->format = $format;
    return $this;
  }

  public function isValid($value) {
    $this->setValue($value);
    $obj = DateTime::createFromFormat($this->format, $value);
    //echo $obj->format('Y-m-d H:i:s');
    if ($obj == false || DateTime::getLastErrors()["warning_count"] != 0 || DateTime::getLastErrors()["error_count"] != 0) {
      $this->createErrorMessage("Please insert correct date and time");
    }
  }

}
