<?php

/**
 * PoFileParser.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n\Gettext;

use Sepia\FileHandler;
use Sepia\PoParser as SepiaPoParser;
use SeekableIterator;

/**
 * Description of PoParser
 *
 * @author Sami Holck
 */
class PoFileIterator extends \FilterIterator implements SeekableIterator {

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
   * @var GettextData[]
   */
  private $objects = [];
  
  private $filter;

  /**
   * 
   * @param string $poFilePath
   */
  public function __construct($poFilePath) {
    $fileHandler = new FileHandler($poFilePath);
    $poParser = new SepiaPoParser($fileHandler);
    $this->parseAll($poParser->parse());
    parent::__construct($this->objects);
    //print_r($this->entries);
  }

  protected function parseAll(array $rawData) {
    $this->entries = [];
    $arr = [];
    foreach ($rawData as $key => $data) {
      $this->entries[$key] = self::parseTranslationData($data);
      $arr[] = self::parseObject($data);
    }
    $this->objects = new \ArrayIterator($arr);
    return $this;
  }

  public function accept() {
    $f = $this->filter;
    if ($f === null) {
      return true;
    }
    else {
      return $f($this->getInnerIterator()->current());
    }
  }
  /**
   * 
   * @param \Sphp\Core\I18n\Gettext\callable $filter
   * @return \Sphp\Core\I18n\Gettext\PoFileIterator
   */
  public function setFilter(callable $filter) {
    $this->filter = $filter;
    return $this;;
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

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return $this->objects[$this->position];
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    ++$this->position;
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return $this->position;
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    $this->position = 0;
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid() {
    return isset($this->objects[$this->position]);
  }

  private $position;

  public function seek($position) {
    if (!isset($this->objects[$position])) {
      throw new OutOfBoundsException("invalid seek position ($position)");
    }

    $this->position = $position;
  }

}
