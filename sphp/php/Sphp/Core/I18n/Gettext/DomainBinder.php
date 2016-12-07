<?php

/**
 * DomainBinder.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n\Gettext;

/**
 * Static gettext domain binder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DomainBinder {

  private static $domains = [];

  /**
   * 
   * @param string $domain
   * @param string $directory
   * @param string $charset
   */
  public static function bindtextdomain($domain, $directory, $charset = 'UTF-8') {
    $value = $domain . $directory;
    if (!in_array($value, self::$domains)) {
      bindtextdomain($domain, $directory);
      self::$domains[] = $value;
      bind_textdomain_codeset($domain, $charset);
    }
  }

  private function __construct() {
    throw new \Exception;
  }

}
