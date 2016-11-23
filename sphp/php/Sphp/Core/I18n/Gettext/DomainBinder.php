<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Core\I18n\Gettext;

/**
 * Description of DomainBinder
 *
 * @author Sami Holck
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
