<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Datetime;

use Sphp\Config\LocaleManager;
use DateTimeInterface;
use IntlDateFormatter;

/**
 * Class localizes weekday and month names
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DateFormatter {

  private DateTimeInterface $date;
  private ?string $locale = null;

  /**
   * Constructor
   * 
   * @param DateTimeInterface|null $dateTime
   */
  public function __construct($dateTime = null) {
    $this->date = \Sphp\DateTime\DateTimes::dateTimeImmutable($dateTime);
  }

  public function __destruct() {
    unset($this->date);
  }

  public function getLocale(): ?string {
    return $this->locale;
  }

  /**
   * 
   * @param  string $locale optional name of the language used for translations
   * @return $this for a fluent interface
   */
  public function setLocale(?string $locale) {
    $this->locale = $locale;
    return $this;
  }

  /**
   * Returns the name or the abbreviation of the weekday
   *
   * @param  int|null $length optional length of the result string
   * @return string the name or the abbreviation of the weekday
   */
  public function getWeekdayName(?int $length = null): string {
    $name = $this->formatICU('cccc');
    if ($length > 0) {
      $name = mb_substr($name, 0, $length);
    }
    return $name;
  }

  /**
   * Returns the name or the abbreviation of the month
   *
   * @param  int|null $length optional length of the result string
   * @return string the name or the abbreviation of the month
   */
  public function getMonthName(?int $length = null): string {
    $monthName = $this->formatICU('LLLL');
    if ($length > 0) {
      $monthName = mb_substr($monthName, 0, $length);
    }
    return $monthName;
  }

  /**
   * ICU stands for: International Components for Unicode
   * 
   * @param  string $format
   * @return string
   * @link   http://userguide.icu-project.org/formatparse/datetime#TOC-Date-Time-Format-Syntax Internationalization patterns
   */
  public function formatICU(string $format): string {
    $result = IntlDateFormatter::formatObject($this->date, $format, $this->getLocale());

    return $result;
  }

  /**
   * Returns a formatted string 
   * 
   * @param  string $format
   * @return string a formatted string 
   */
  public function strftime(string $format): string {
    if ($this->getLocale() !== null) {
      $localeManager = new LocaleManager();
      $localeManager->setLocale(\LC_TIME, $this->getLocale());
    }
    $output = strftime($format, $this->date->getTimestamp());
    if ($this->getLocale() !== null) {
      $localeManager->restoreLocales(\LC_TIME);
    }
    return utf8_encode($output);
  }

  /**
   * Returns the week of year
   * 
   * @return int the week of year
   */
  public function getWeekOfYear(): int {
    return (int) $this->formatICU('w');
  }

  /**
   * Returns the week of year
   * 
   * @return int the week of year
   */
  public function getDayOfYear(): int {
    return (int) $this->formatICU('D');
  }

}
