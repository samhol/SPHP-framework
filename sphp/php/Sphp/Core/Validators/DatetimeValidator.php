<?php

/**
 * DatetimeValidator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use DateTime;

/**
 * Class validates a datetime string
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-26-08
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DatetimeValidator extends AbstractOptionalValidator {

  /**
   * the required format of the validable value
   *
   * @var string
   */
  private $format = "Y-m-d H:i:s";

  /**
   * Constructs a new {@link DatetimeValidator} object
   *
   * @param string $format the required format of the validable value
   */
  public function __construct($format = "Y-m-d H:i:s") {
    parent::__construct();
    if ($format !== null) {
      $this->setDateTimeFormat($format);
    }
  }

  /**
   * Sets the required format of the validable value
   *
   * @param string $format the required format of the validable value
   * @return self for PHP Method Chaining
   */
  public function setDateTimeFormat($format) {
    $this->format = $format;
    return $this;
  }

  /**
   * Does the actual validation
   *
   *  Executed only if the <var>$value</var> is either non empty or empty
   *  values are set to be validated.
   *
   * @param  mixed $value the value to validate
   */
  protected function executeValidation($value) {
    $obj = DateTime::createFromFormat($this->format, $value);
    //echo $obj->format('Y-m-d H:i:s');
    if ($obj == false || DateTime::getLastErrors()["warning_count"] != 0 || DateTime::getLastErrors()["error_count"] != 0) {
      $this->createErrorMessage("Please insert correct date and time");
    }
  }

}
