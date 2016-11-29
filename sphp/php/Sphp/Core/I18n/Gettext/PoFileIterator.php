<?php

/**
 * PoFileParser.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n\Gettext;

use Sepia\FileHandler;
use Sepia\PoParser as SepiaPoParser;
use Sphp\Data\Collection;

/**
 * Description of PoParser
 *
 * @author Sami Holck
 */
class PoFileIterator implements \Iterator {

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
   * @var Collection 
   */
  private $objects;

  /**
   * 
   * @param string $poFilePath
   */
  public function __construct($poFilePath) {
    //$this->poFilePath = $poFilePath;
    $this->objects = $this->parseFromFile($poFilePath);
    //print_r($this->entries);
  }

  protected function parseFromFile($poFilePath) {
    $fileHandler = new FileHandler($poFilePath);
    $poParser = new SepiaPoParser($fileHandler);
    $rawData = $poParser->parse();
    //$this->entries = [];
    $arr = [];
    foreach ($rawData as $data) {
      //$this->entries[$key] = self::parseTranslationData($data);
      $arr[] = self::parseObject($data);
    }
    //$this->objects = new \Sphp\Data\Collection($arr);
    return new Collection($arr);
  }

  /**
   * 
   * @param  callable $callback
   * @return Collection
   */
  public function filter(callable $callback) {
    return $this->objects->filter($callback, 0);
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
    return $this->objects;
  }

  /**
   * 
   * @return Collection
   */
  public function getSingulars() {
    $singularFilter = function(GettextData $entry) {
      return !$entry instanceof PluralGettextData;
    };
    return $this->filter($singularFilter);
  }

  /**
   * 
   * @return Collection
   */
  public function getPlurals() {
    $pluralFilter = function(GettextData $entry) {
      return $entry instanceof PluralGettextData;
    };
    return $this->filter($pluralFilter);
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

  private static function parseObject(array $data) {
    $flags = null;
    if (array_key_exists('flags', $data)) {
      $flags = $data['flags'][0];
    }
    $msgid = null;
    if (array_key_exists('msgid', $data)) {
      $msgid = $data['msgid'][0];
    }
    $msgstr = null;
    if (array_key_exists('msgstr', $data)) {
      $msgstr = $data['msgstr'][0];
    }
    if (array_key_exists('msgstr[0]', $data)) {
      $msgstr = $data['msgstr[0]'][0];
    }
    if (array_key_exists('msgid_plural', $data) && array_key_exists('msgstr[1]', $data)) {
      $pluralId = $data['msgid_plural'][0];
      $pluralMessageString = $data['msgstr[1]'][0];
      $object = new PluralGettextData($msgid, $msgstr, $pluralId, $pluralMessageString, $flags);
    } else {
      $object = new GettextData($msgid, $msgstr, $flags);
    }
    return $object;
  }

  public function current() {
    return $this->objects->current();
  }

  public function key() {
    return $this->objects->key();
  }

  public function next() {
    $this->objects->next();
  }

  public function rewind() {
    $this->objects->rewind();
  }

  public function valid() {
    return $this->objects->valid();
  }

  public function count() {
    return $this->objects->count();
  }

}
