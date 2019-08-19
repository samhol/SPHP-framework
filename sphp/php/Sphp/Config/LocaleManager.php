<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

/**
 * Implementation of LocaleManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LocaleManager {

  /**
   * @var string
   */
  private $localeMap;

  /**
   * Constructor
   */
  public function __construct() {
    $this->localeMap = $this->__toString();
    //$this->getCorrectLocales();
  }

  public static function getCurrenttLocalesAsArray(): array {
    $localeNames = [
        'LC_ALL',
        'LC_COLLATE',
        'LC_CTYPE',
        'LC_MONETARY',
        'LC_NUMERIC',
        'LC_TIME',
        'LC_MESSAGES'];
    $locales = [];
    foreach ($localeNames as $name) {
      if (defined($name)) {
        $locales[$name] = setlocale(constant($name), 0);
      }
    }
    return $locales;
  }

  /**
   * Sets the locale information
   *
   * **`$category` constant values:**
   * <ul>
   * <li> {@link \LC_ALL} for all of the below </li>
   * <li> {@link \LC_COLLATE} for string comparison, see {@link strcoll()} </li>
   * <li> {@link \LC_CTYPE} for character classification and conversion, for example {@link strtoupper()} </li>
   * <li> {@link \LC_MONETARY} for localeconv() </li>
   * <li> {@link \LC_NUMERIC} for decimal separator (See also {@link localeconv()}) </li>
   * <li> {@link \LC_TIME} for date and time formatting with {@link strftime()} </li>
   * <li> {@link \LC_MESSAGES} for system responses (available if PHP was compiled with libintl) </li>
   * </ul>
   * 
   * @param  int $category a named constant specifying the category of the functions affected by the locale setting:
   * @param  string ... $locale the name of the locale
   * @return $this for a fluent interface
   * @throws Exception\ConfigurationException if locale setting failed
   */
  public function setLocale(string ...$locale) {
    if (!\setLocale(\LC_ALL, $locale)) {
      throw new Exception\ConfigurationException('Locale setting failed');
    }
    return $this;
  }

  /**
   * 
   * 
   * @param callable $executable
   * @param string $locale
   * @return $this for a fluent interface
   */
  public function run(callable $executable, string $locale) {
    $this->setLocale($locale);
    $executable();
    $this->restoreLocales();
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
   * @param string $category a named constant specifying the category of the functions affected by the locale setting:
   * @return string the name (filename) of the text domain
   */
  public function getLocale(string $category): string {
    $currentLocales = static::getCurrenttLocalesAsArray();
    if (!array_key_exists($category, $currentLocales)) {
      throw new Exception\ConfigurationException('Locale category does not exist in this configuration');
    }
    return $currentLocales[$category];
  }

  public function __toString(): string {
    return setlocale(LC_ALL, '0');
  }

  public function restoreLocales() {
    \setLocale(\LC_ALL, $this->localeMap);
    return $this;
  }

}
