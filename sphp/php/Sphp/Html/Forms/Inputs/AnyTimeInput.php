<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements a Any+Time datetime-input widget
 *
 * **Note!** This element uses Any+Time DatePicker/TimePicker AJAX Calendar 
 * Widget for its functionality.
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @link    http://www.ama3.com/anytime/ Any+Time Calendar Widget
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AnyTimeInput extends InputTag {

  /**
   * Constructor
   *
   * @param  string $name name attribute
   * @param  string $value the value of the attribute
   * @param  string $format used language and locale
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct(string $name = null, $value = null, string $format = '%Y-%m-%d %H:%i') {
    parent::__construct('text', $name, $value);
    $this->attributes()->protect('data-anytime', true);
    $this->cssClasses()->protectValue('sphp','AnyTimeInput');
    $this->identify();
    $this->setDateTimeFormat($format);
  }

  public function setPlaceholder(string $placeholder = null) {
    $this->attributes()->setAttribute('placeholder', $placeholder);
    return $this;
  }

  /**
   * Sets used language.
   *
   * @param  string $locale used language and locale
   * @return $this for a fluent interface
   */
  public function setLocale(string $locale = null) {
    $this->setAttribute('data-sphp-locale', $locale);
    return $this;
  }

  /**
   * Sets used datetime format
   * 
   * **Default format:** `%Y-%m-%d %H:%i`
   *
   * The following format specifiers are recognized:
   * 
   * * `%a`: Abbreviated weekday name (Sun...Sat)
   * * `%B`: Abbreviation for Before Common Era (if year<1)*
   * * `%b`: Abbreviated month name (Jan...Dec)
   * * `%C`: Abbreviation for Common Era (if year>=1)*
   * * `%c`: Month, numeric (1..12)
   * * `%D`: Day of the month with English suffix (1st, 2nd, ...)
   * * `%d`: Day of the month, numeric (00...31)
   * * `%E`: Era abbreviation*
   * * `%e`: Day of the month, numeric (0...31)
   * * `%H`: Hour (00...23)
   * * `%h`: Hour (01...12)
   * * `%I`: Hour (01...12)
   * * `%i`: Minutes, numeric (00...59)
   * * `%k`: Hour (0...23)
   * * `%l`: Hour (1...12)
   * * `%M`: Month name (January...December)
   * * `%m`: Month, numeric (01...12)
   * * `%p`: AM or PM
   * * `%r`: Time, 12-hour (hh:mm:ss followed by AM or PM)
   * * `%S`: Seconds (00...59)
   * * `%s`: Seconds (00...59)
   * * `%T`: Time, 24-hour (hh:mm:ss)
   * * `%W`: Weekday name (Sunday...Saturday)
   * * `%w`: Day of the week (0=Sunday...6=Saturday)
   * * `%Y`: Year, numeric, four digits (possibly signed)
   * * `%y`: Year, numeric, two digits (possibly signed)
   * * `%Z`: Year, numeric, four digits (no sign)*
   * * `%z`: Year, numeric, variable length (no sign)*
   * * `%#`: Signed UTC offset in minutes*
   * * `%+`: Signed UTC offset in %h%i format*
   * * `%-`: Signed UTC offset in %l%i format*
   * * `%:`: Signed UTC offset in %h:%i format*
   * * `%;`: Signed UTC offset in %l:%i format*
   * * `%@`: UTC offset time zone label*
   * * `%%`: A literal % character
   *
   * @param  string $format datetime format
   * @return $this for a fluent interface
   */
  public function setDateTimeFormat(string $format = '%Y-%m-%d %H:%i') {
    $this->setAttribute('data-format', $format);
    return $this;
  }

}
