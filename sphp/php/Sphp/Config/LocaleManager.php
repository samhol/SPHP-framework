<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use Sphp\Exceptions\BadMethodCallException;

/**
 * Implementation of LocaleManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LocaleManager {

  private static $localeMap = [
      'All' => LC_ALL, // for all of the below
      'Collate' => LC_COLLATE, // for string comparison, see strcoll()
      'Ctype' => LC_CTYPE, // for character classification and conversion, for example strtoupper()
      'Monetary' => LC_MONETARY, // for localeconv()
      'Numeric' => LC_NUMERIC, // for decimal separator(See also localeconv())
      'Time' => LC_TIME, // for date and time formatting with strftime()
      'Messages' => LC_MESSAGES, // for system responses (available if PHP was compiled with libintl);
  ];

  public function __call(string $name, array $arguments) {
    $locale = str_replace(['set', 'get'], '', $name);
    if (!isset(static::$localeMap[$locale])) {
      throw new BadMethodCallException("Method $name does not exist");
    }
    $category = static::$localeMap[$locale];
    if (\Sphp\Stdlib\Strings::startsWith($name, 'set')) {
      return $this->setLocale($category, $name);
    } else if (\Sphp\Stdlib\Strings::startsWith($name, 'get')) {
      return $this->getLocale($category, $name);
    }
  }

  /**
   * Sets the locale information
   *
   * **`$category` constant values:**
   * <ul>
   * <li> {@link LC_ALL} for all of the below </li>
   * <li>{@link LC_COLLATE} for string comparison, see {@link strcoll()} </li>
   * <li> {@link LC_CTYPE} for character classification and conversion, for example {@link strtoupper()} </li>
   * <li> {@link LC_MONETARY} for localeconv() </li>
   * <li> {@link LC_NUMERIC} for decimal separator (See also {@link localeconv()}) </li>
   * <li> {@link LC_TIME} for date and time formatting with {@link strftime()} </li>
   * <li> {@link LC_MESSAGES} for system responses (available if PHP was compiled with libintl) </li>
   * </ul>
   * 
   * @param  int $category a named constant specifying the category of the functions affected by the locale setting:
   * @param  string $locale the name of the locale
   * @return $this for a fluent interface
   * @throws Exception\ConfigurationException if locale setting failed
   */
  public function setLocale(int $category, string $locale) {
    if (!setLocale($category, $locale)) {
      throw new Exception\ConfigurationException('Locale setting failed');
    }
    return $this;
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
  public function getLocale(int $category): string {
    return setLocale($category, '0');
  }

}
