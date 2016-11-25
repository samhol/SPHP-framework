<?php

/**
 * PoParser.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n\Gettext;

use Sepia\FileHandler;
use Sepia\PoParser as SepiaPoParser;

/**
 * Description of PoParser
 *
 * @author Sami Holck
 */
class PoParser {

  const SINGULAR_ID = 'msgid';
  const PLURAL_ID = 'msgid_plural';
  const SINGULAR_MESSAGE = 'msgstr_singular';
  const PLURAL_MESSAGE = 'msgstr_plural';

  /**
   *
   * @var array 
   */
  private $entries = [];

  /**
   * 
   * @param string $poFilePath
   */
  public function __construct($poFilePath) {
    $fileHandler = new FileHandler($poFilePath);
    $poParser = new SepiaPoParser($fileHandler);
    $this->entries = $poParser->parse();
    //print_r($this->entries);
  }

  /**
   * 
   * @return string[]
   */
  public function getSingularIds() {
    return array_keys($this->entries);
  }

  /**
   * 
   * @return array
   */
  public function getSingulars() {
    $result = [];
    foreach ($this->entries as $data) {
      if (!array_key_exists('msgid_plural', $data)) {
        $result[] = self::parseTranslationData($data);
      }
    }
    return $result;
  }

  /**
   * 
   * @return array
   */
  public function getPlurals() {
    $result = [];
    foreach ($this->entries as $data) {
      if (array_key_exists('msgid_plural', $data)) {
        $result[] = self::parseTranslationData($data);
      }
    }
    return $result;
  }

  private static function parseTranslationData(array $data) {
    if (array_key_exists('flags', $data)) {
      $instance['flags'] = $data['flags'][0];
    }
    if (array_key_exists('msgid', $data)) {
      $instance['msgid'] = $data['msgid'][0];
    }
    if (array_key_exists('msgid_plural', $data)) {
      $instance[self::PLURAL_ID] = $data['msgid_plural'][0];
    }
    if (array_key_exists('msgstr[0]', $data)) {
      $instance[self::SINGULAR_MESSAGE] = $data['msgstr[0]'][0];
    }
    if (array_key_exists('msgstr[1]', $data)) {
      $instance[self::PLURAL_MESSAGE] = $data['msgstr[1]'][0];
    }
    return $instance;
  }

}
