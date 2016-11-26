<?php

/**
 * PoFileParser.php (UTF-8)
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
class PoFileParser {

  const MESSAGE_ID = 'msgid';
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
    $this->parseAll($poParser->parse());
    //print_r($this->entries);
  }

  protected function parseAll(array $rawData) {
    $this->entries = [];
    foreach ($rawData as $key => $data) {
      $this->entries[$key] = self::parseTranslationData($data);
    }
    return $this;
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
  public function getAll() {
    return $this->entries;
  }

  /**
   * 
   * @return array
   */
  public function getSingulars() {
    $result = [];
    foreach ($this->entries as $key => $data) {
      if (!array_key_exists('msgid_plural', $data)) {
        $result[$key] = $data;
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
    foreach ($this->entries as $key => $data) {
      if (array_key_exists('msgid_plural', $data)) {
        $result[$key] = $data;
      }
    }
    return $result;
  }

  private static function parseTranslationData(array $data) {
    if (array_key_exists('flags', $data)) {
      $instance['flags'] = $data['flags'][0];
    }
    if (array_key_exists('msgid', $data)) {
      $instance[self::MESSAGE_ID] = $data['msgid'][0];
    }
    if (array_key_exists('msgid_plural', $data)) {
      $instance[self::PLURAL_ID] = $data['msgid_plural'][0];
    }
    if (array_key_exists('msgstr', $data)) {
      $instance[self::SINGULAR_MESSAGE] = $data['msgstr'][0];
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
