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
   * @return PoFileIterator
   */
  public static function gettextIterator() {
    if (self::$parser === null) {
      self::$parser = new PoFileIterator(\Sphp\LOCALE_PATH . '\fi_FI\LC_MESSAGES\Sphp.Defaults.po');
    }
    return self::$parser;
  }
  /**
   * @return array
   */
  public function allMessageStrings() {
    $parser = self::gettextIterator();
    $args = [];
    foreach ($parser->getAll() as $data) {
      $args[] = [$data];
    }
    return $args;
  }
  /**
   * @return array
   */
  public function singulars() {
    $args = [];
    foreach (self::gettextIterator()->getSingulars() as $data) {
      $args[] = [$data];
    }
    return $args;
  }
  
  public function plurals() {
    $parser = self::gettextIterator();
    $args = [];
    foreach ($parser->getPlurals() as $data) {
      $args[] = [$data];
    }
    return $args;
  }

}
