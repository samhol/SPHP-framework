<?php

/**
 * Locale.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Config;

/**
 * Class for different locale settings
 *
 * **Links:**
 *
 * * {@link http://php.net/manual/en/function.setlocale.php}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Locale {

  /**
   * Sets the locale information
   *
   * **`$category` constant values:**
   *
   * * {@link LC_ALL} for all of the below
   * * {@link LC_COLLATE} for string comparison, see {@link strcoll()}
   * * {@link LC_CTYPE} for character classification and conversion, for example {@link strtoupper()}
   * * {@link LC_MONETARY} for localeconv()
   * * {@link LC_NUMERIC} for decimal separator (See also {@link localeconv()})
   * * {@link LC_TIME} for date and time formatting with {@link strftime()}
   * * {@link LC_MESSAGES} for system responses (available if PHP was compiled with libintl)
   *
   * @param  int $category a named constant specifying the category of the functions affected by the locale setting:
   * @param  string $locale the name of the locale
   * @return boolean true if the setting was succesfull and false otherwise
   */
  public static function setLocale(int $category, $locale): bool {
    return setLocale($category, $locale) !== false;
  }

  /**
   * Sets the locale information for system responses
   *
   * @param  string $locale the locale information for system responses
   * @return boolean true if the setting was successful and false otherwise
   */
  public static function setMessageLocale(string $locale): bool {
    return self::setLocale(\LC_MESSAGES, $locale);
  }

  /**
   * Returns the locale information
   *
   * **`$category` constant values:**
   *
   * * {@link LC_ALL} for all of the below
   * * {@link LC_COLLATE} for string comparison, see {@link strcoll()}
   * * {@link LC_CTYPE} for character classification and conversion, for example {@link strtoupper()}
   * * {@link LC_MONETARY} for localeconv()
   * * {@link LC_NUMERIC} for decimal separator (See also {@link localeconv()})
   * * {@link LC_TIME} for date and time formatting with {@link strftime()}
   * * {@link LC_MESSAGES} for system responses (available if PHP was compiled with libintl)
   *
   * @param int $category a named constant specifying the category of the functions affected by the locale setting:
   * @return string the name (filename) of the text domain
   */
  public static function getLocale($category): string {
    return setLocale($category, '0');
  }

  /**
   * Returns the current locale setting for date and time formatting
   *
   * @return string the current locale setting for date and time formatting
   */
  public static function getDatetimeLocale(): string {
    return self::getLocale(LC_TIME);
  }

  /**
   * Returns the current locale setting for system responses
   *
   * @return string the current locale setting for system responses
   */
  public static function getMessageLocale(): string {
    return self::getLocale(LC_MESSAGES);
  }

}
