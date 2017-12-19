<?php

/**
 * DatetimeValidator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use DateTime;
use Sphp\I18n\Messages\Message;

/**
 * Validates a datetime
 *
 * @author  Sami Holck <sami.holck@gmail.com>
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
  public function __construct(string $format = 'Y-m-d H:i:s') {
    parent::__construct();
    if ($format !== null) {
      $this->setDateTimeFormat($format);
    }
    $this->setMessageTemplate(static::INVALID, Message::singular('Please insert correct date and time'));
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
    $obj = DateTime::createFromFormat($this->format, $value);
    //echo $obj->format('Y-m-d H:i:s');
    if ($obj == false || DateTime::getLastErrors()["warning_count"] != 0 || DateTime::getLastErrors()["error_count"] != 0) {
      $this->error(static::INVALID);
    }
  }

}
