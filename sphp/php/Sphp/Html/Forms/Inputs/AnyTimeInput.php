<?php

/**
 * DateTimeInput.php
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements a Any+Time datetime-input widget
 *
 * **Note!** This element uses Any+Time DatePicker/TimePicker AJAX Calendar Widget for its functionality.
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2012-04-11
 * @link    http://www.ama3.com/anytime/ Any+Time Calendar Widget
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AnyTimeInput extends TextInput {

  const LANG_FI = "fi";
  const LANG_EN = "en";

  /**
   * used language
   *
   * @var string
   */
  private $locale = self::LANG_EN;

  /**
   * used datetime format
   *
   * @var string
   */
  private $format = "%Y-%m-%d %H:%i";

  /**
   * Constructs a new instance
   *
   * **supported languages:**
   * 
   * * {@link self::LANG_EN}: english
   * * {@link self::LANG_FI}: finnish
   * 
   * @param  string $name name attribute
   * @param  string $value the value of the attribute
   * @param  string $locale used language and locale
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   */
  public function __construct($name = "", $value = "", $locale = self::LANG_EN) {
    parent::__construct($name, $value, 17, 17);
    $this->attrs()->demand("data-anytime");
    $this->identify();
    $this->setDateTimeFormat()
            ->setLocale($locale);
  }

  /**
   * Sets used language.
   *
   * **supported languages:**
   * 
   * * {@link self::LANG_EN}: english
   * * {@link self::LANG_FI}: finnish
   * 
   * @param  string $locale used language and locale
   * @return self for a fluent interface
   */
  public function setLocale($locale) {
    $this->locale = $locale;
    $this->setAttr("data-locale", $locale);
    return $this;
  }

  /**
   * Sets used datetime format
   * 
   * **Default format:** <var>%Y-%m-%d %H:%i</var>
   *
   * The following format specifiers are recognized:
   * 
   * * <var>%a</var>: Abbreviated weekday name (Sun...Sat)
   * * <var>%B</var>: Abbreviation for Before Common Era (if year<1)*
   * * <var>%b</var>: Abbreviated month name (Jan...Dec)
   * * <var>%C</var>: Abbreviation for Common Era (if year>=1)*
   * * <var>%c</var>: Month, numeric (1..12)
   * * <var>%D</var>: Day of the month with English suffix (1st, 2nd, ...)
   * * <var>%d</var>: Day of the month, numeric (00...31)
   * * <var>%E</var>: Era abbreviation*
   * * <var>%e</var>: Day of the month, numeric (0...31)
   * * <var>%H</var>: Hour (00...23)
   * * <var>%h</var>: Hour (01...12)
   * * <var>%I</var>: Hour (01...12)
   * * <var>%i</var>: Minutes, numeric (00...59)
   * * <var>%k</var>: Hour (0...23)
   * * <var>%l</var>: Hour (1...12)
   * * <var>%M</var>: Month name (January...December)
   * * <var>%m</var>: Month, numeric (01...12)
   * * <var>%p</var>: AM or PM
   * * <var>%r</var>: Time, 12-hour (hh:mm:ss followed by AM or PM)
   * * <var>%S</var>: Seconds (00...59)
   * * <var>%s</var>: Seconds (00...59)
   * * <var>%T</var>: Time, 24-hour (hh:mm:ss)
   * * <var>%W</var>: Weekday name (Sunday...Saturday)
   * * <var>%w</var>: Day of the week (0=Sunday...6=Saturday)
   * * <var>%Y</var>: Year, numeric, four digits (possibly signed)
   * * <var>%y</var>: Year, numeric, two digits (possibly signed)
   * * <var>%Z</var>: Year, numeric, four digits (no sign)*
   * * <var>%z</var>: Year, numeric, variable length (no sign)*
   * * <var>%#</var>: Signed UTC offset in minutes*
   * * <var>%+</var>: Signed UTC offset in %h%i format*
   * * <var>%-</var>: Signed UTC offset in %l%i format*
   * * <var>%:</var>: Signed UTC offset in %h:%i format*
   * * <var>%;</var>: Signed UTC offset in %l:%i format*
   * * <var>%@</var>: UTC offset time zone label*
   * * <var>%%</var>: A literal % character
   *
   * @param  string $format datetime format
   * @return self for a fluent interface
   */
  public function setDateTimeFormat($format = "%Y-%m-%d %H:%i") {
    $this->format = $format;
    $this->setAttr("data-format", $format);
    return $this;
  }

}
