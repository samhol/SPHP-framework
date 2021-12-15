<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config;

use Sphp\Config\Exception\ConfigurationException;

/**
 * Implementation of LocaleManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class LocaleManager {

  private array $locales = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->usedLocales = setlocale(LC_ALL, '0');
    $this->locales = self::listCurrentLocaleInformation();
  }

  /**
   * Sets the locale information
   *
   * **`$category` constant values:**
   *
   * * {@see \LC_ALL} for all of the below
   * * {@see \LC_COLLATE} for string comparison, see {@see \strcoll()}
   * * {@see \LC_CTYPE} for character classification and conversion, for example {@see \strtoupper()}
   * * {@see \LC_MONETARY} for {@see \localeconv()}
   * * {@see \LC_NUMERIC} for decimal separator (See also {@see \localeconv()})
   * * {@see \LC_TIME} for date and time formatting with {@see \strftime()}
   * * {@see \LC_MESSAGES} for system responses (available if PHP was compiled with libintl)
   * 
   * @param  int $category a named constant specifying the category of the 
   *                       functions affected by the locale setting
   * @param  string $locales a locale settings string
   * @param  string $rest optional string parameters to try as locale settings 
   *                      until success
   * @return $this for a fluent interface
   * @throws ConfigurationException if the locale functionality is not implemented 
   *                                on your platform, the specified locale does 
   *                                not exist or the category name is invalid
   */
  public function setLocale(int $category, string $locales, string ...$rest) {
    //var_dump($locale, \setLocale(\LC_ALL, $locale));
    $cat = \setLocale($category, $locales, ...$rest);
    if ($cat === false) {
      throw new ConfigurationException('Locale information setting failed');
    }
    return $this;
  }

  /**
   * Executes a Callable in given locale and switches back to original locale
   * 
   * **`$category` constant values:**
   *
   * * {@see \LC_ALL} for all of the below
   * * {@see \LC_COLLATE} for string comparison, see {@see \strcoll()}
   * * {@see \LC_CTYPE} for character classification and conversion, for example {@see \strtoupper()}
   * * {@see \LC_MONETARY} for {@see \localeconv()}
   * * {@see \LC_NUMERIC} for decimal separator (See also {@see \localeconv()})
   * * {@see \LC_TIME} for date and time formatting with {@see \strftime()}
   * * {@see \LC_MESSAGES} for system responses (available if PHP was compiled with libintl)
   * 
   * @param  callable $callable
   * @param  string $locale
   * @return $this for a fluent interface
   * @throws ConfigurationException if the locale functionality is not implemented 
   *                                on your platform, the specified locale does 
   *                                not exist or the category name is invalid
   */
  public function run(callable $callable, int $category, string $locale, string ...$rest) {
    $this->setLocale($category, $locale, ...$rest);
    $callable();
    $this->restoreLocales($category);
    return $this;
  }

  /**
   * Returns the locale information
   *
   * **`$category` constant values:**
   *
   * * {@see \LC_ALL} for all of the below
   * * {@see \LC_COLLATE} for string comparison, see {@see \strcoll()}
   * * {@see \LC_CTYPE} for character classification and conversion, for example {@see \strtoupper()}
   * * {@see \LC_MONETARY} for {@see \localeconv()}
   * * {@see \LC_NUMERIC} for decimal separator (See also {@see \localeconv()})
   * * {@see \LC_TIME} for date and time formatting with {@see \strftime()}
   * * {@see \LC_MESSAGES} for system responses (available if PHP was compiled with libintl)
   *
   * @param  int $category a named constant specifying the category of the 
   *                       functions affected by the locale setting
   * @return string the name (filename) of the text domain
   * @throws ConfigurationException if the the category is invalid
   */
  public static function getLocale(int $category): string {
    $out = setlocale($category, '0');
    if ($out == false) {
      throw new ConfigurationException('Locale category is invalid');
    }
    return $out;
  }

  /**
   * Restores the original locale for given category
   * 
   * **`$category` constant values:**
   *
   * * {@see \LC_ALL} for all of the below
   * * {@see \LC_COLLATE} for string comparison, see {@see \strcoll()}
   * * {@see \LC_CTYPE} for character classification and conversion, for example {@see \strtoupper()}
   * * {@see \LC_MONETARY} for {@see \localeconv()}
   * * {@see \LC_NUMERIC} for decimal separator (See also {@see \localeconv()})
   * * {@see \LC_TIME} for date and time formatting with {@see \strftime()}
   * * {@see \LC_MESSAGES} for system responses (available if PHP was compiled with libintl)
   * 
   * @param  int $category a named constant specifying the category of the 
   *                       functions affected by the locale setting
   * @return $this for a fluent interface
   * @throws ConfigurationException if the the category is invalid
   */
  public function restoreLocales(int $category) {
    if (array_key_exists($category, $this->locales)) {
      \setLocale($category, $this->locales[$category]);
    } else {
      throw new ConfigurationException('Locale category is invalid');
    }
    return $this;
  }

  /**
   * 
   * @return array<int,string>
   */
  public static function listCurrentLocaleInformation(): array {
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
        $locales[constant($name)] = setlocale(constant($name), 0);
      }
    }
    return $locales;
  }

}
