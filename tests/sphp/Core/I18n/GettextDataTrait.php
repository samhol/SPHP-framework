<?php

namespace Sphp\Core\I18n;

use Sphp\Core\I18n\Gettext\PoFileIterator;

trait GettextDataTrait  {

  /**
   *
   * @var PoFileParser 
   */
  private static $parser;

  /**
   * 
   * @return PoFileParser
   */
  public static function getPoFileParser() {
    if (self::$parser === null) {
      self::$parser = new PoFileIterator(\Sphp\LOCALE_PATH . '\fi_FI\LC_MESSAGES\Sphp.Defaults.po');
    }
    return self::$parser;
  }
  
  public function allMessageStrings() {
    $parser = self::getPoFileParser();
    $args = [];
    foreach ($parser->getAll() as $data) {
      $args[] = [$data];
    }
    return $args;
  }
  
  public function plurals() {
    $parser = self::getPoFileParser();
    $args = [];
    foreach ($parser->getPlurals() as $data) {
      $args[] = [$data];
    }
    return $args;
  }

}
