<?php

/**
 * DomainBinder.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\I18n\Gettext;

use Sphp\Exceptions\InvalidArgumentException;

/**
 * Static gettext domain binder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class DomainBinder {

  private static $domains = [];

  /**
   * 
   * @param  string $domain
   * @param  string $directory
   * @param  string $charset
   * @throws InvalidArgumentException
   */
  public static function bindtextdomain(string $domain, string $directory, string $charset = null) {
    if (empty($domain)) {
      var_dump($domain);
      //throw new InvalidArgumentException('The domain parameter must not be empty');
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
