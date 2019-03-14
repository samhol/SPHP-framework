<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\I18n\Gettext;

use Sepia\PoParser\SourceHandler\FileSystem;
use Sepia\PoParser\Parser;
use Sphp\Stdlib\Datastructures\Collection;

/**
 * Iterator for *.po files
 * 
 * Iterator parses a Gettext Portable file and acts as an iterator for all gettext instances in the file
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @uses    https://github.com/raulferras/PHP-po-parser Po Parser
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PoFileIterator implements \Iterator {

  /**
   * @var Collection 
   */
  private $objects;

  /**
   * Constructor
   * 
   * @param Collection $entries
   */
  public function __construct(Collection $entries) {
    $this->objects = $entries;
  }

  public static function parseFrom(string $poFilePath): PoFileIterator {
    $fileHandler = new FileSystem($poFilePath);
    $poParser = new Parser($fileHandler);
    $rawData = $poParser->parse();
    //$this->entries = [];
    $arr = [];
    foreach ($rawData as $data) {
      $arr[] = static::parseObject($data);
    }
    return new static(new Collection($arr));
  }

  /**
   * Filters components using the given callable
   * 
   * @param  callable $callback
   * @return PoFileIterator a subset of objects
   */
  public function filter(callable $callback): PoFileIterator {
    return new static($this->objects->filter($callback, 0));
  }

  /**
   * 
   * @param  string $id
   * @return PoFileIterator
   */
  public function getById(string $id): PoFileIterator {
    $idFilter = function(GettextData $entry) use ($id) {
      return !$entry->getMessageId() === $id;
    };
    return $this->filter($idFilter);
  }

  /**
   * Returns a subset containing singular forms only
   * 
   * @return PoFileIterator containing singular forms only
   */
  public function getSingulars(): PoFileIterator {
    $singularFilter = function(GettextData $entry) {
      return !$entry instanceof PluralGettextData;
    };
    return $this->filter($singularFilter);
  }

  /**
   * Returns a subset containing plural forms only
   * 
   * @return PoFileIterator containing plural forms only
   */
  public function getPlurals(): PoFileIterator {
    $pluralFilter = function(GettextData $entry) {
      return $entry instanceof PluralGettextData;
    };
    return $this->filter($pluralFilter);
  }

  /**
   * 
   * @param  array $data
   * @return GettextData
   */
  private static function parseObject(array $data): GettextData {
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

  public function valid(): bool {
    return $this->objects->valid();
  }

  public function count(): int {
    return $this->objects->count();
  }

  public function toArray(): array {
    return $this->objects->toArray();
  }

}
