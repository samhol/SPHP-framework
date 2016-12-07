<?php

/**
 * PoFileIterator.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Core\I18n\Gettext;

use Sepia\FileHandler;
use Sepia\PoParser as SepiaPoParser;
use Sphp\Data\Collection;

/**
 * Iterator for po files
 * 
 * Iterator parses a Gettext Portable file and acts as an iterator for all gettext instances in the file
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-02-25
 * @uses    https://github.com/raulferras/PHP-po-parser Po Parser
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PoFileIterator implements \Iterator {

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
    $this->objects = $this->parseFromFile($poFilePath);
  }

  protected function parseFromFile($poFilePath) {
    $fileHandler = new FileHandler($poFilePath);
    $poParser = new SepiaPoParser($fileHandler);
    $rawData = $poParser->parse();
    //$this->entries = [];
    $arr = [];
    foreach ($rawData as $data) {
      $arr[] = self::parseObject($data);
    }
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

  /**
   * 
   * @param array $data
   * @return self for PHP Method Chaining
   */
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
