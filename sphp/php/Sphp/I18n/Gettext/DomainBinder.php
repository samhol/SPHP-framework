<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Gettext;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Static gettext domain binder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class DomainBinder {

  private static $domains = [];

  /**
   * Binds a text domain
   * 
   * @param  string $domain
   * @param  string $directory
   * @param  string $charset
   * @throws InvalidArgumentException
   */
  public static function bindtextdomain(string $domain, string $directory, string $charset = null) {
    if (empty($domain)) {
      throw new InvalidArgumentException('The domain parameter must not be empty');
    }
    if ($charset === null) {
      $charset = mb_internal_encoding();
    }
    $value = $domain . $directory;
    if (!in_array($value, self::$domains)) {
      bindtextdomain($domain, $directory);
      self::$domains[] = $value;
      bind_textdomain_codeset($domain, $charset);
    }
  }

}
