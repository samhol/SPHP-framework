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
use Sepia\PoParser\Catalog\Catalog;
use Sepia\PoParser\Catalog\CatalogArray;
use Sepia\PoParser\Catalog\Entry;
use Sphp\Stdlib\Datastructures\Collection;
use IteratorAggregate;
use Traversable;

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
class PoFileIterator  implements IteratorAggregate {

  /**
   * @var Entry[] 
   */
  private $entries;

  /**
   * Constructor
   * 
   * @param Catalog|Entry[] $entries
   */
  public function __construct($entries) {
    if ($entries instanceof Catalog) {
      $entries = $entries->getEntries();
    }
    $this->entries = $entries;
    //print_r($entries);
  }
  
  public function __destruct() {
    unset($this->entries);
  }

  public function sort(callable $cond) {
    usort($this->entries, $cond);
    return $this;
  }
  
  public function append(Entry $e) {
    $this->entries[] = $e;
    return $this;
  }

  /**
   * Filters components using the given callable
   * 
   * @param  callable $callback
   * @return PoFileIterator a subset of objects
   */
  public function filter(callable $callback, $flag = 0): PoFileIterator {
    return new static(array_filter($this->entries, $callback, $flag));
  }

  /**
   * 
   * @param  string $id
   * @return PoFileIterator
   */
  public function getById(string $id): PoFileIterator {
    $idFilter = function(Entry $entry) use ($id) {
      return !$entry->getMsgId() === $id;
    };
    return $this->filter($idFilter);
  }

  /**
   * Returns a subset containing singular forms only
   * 
   * @return PoFileIterator containing singular forms only
   */
  public function getSingulars(): PoFileIterator {
    $singularFilter = function(Entry $entry) {
      return !$entry->isPlural();
    };
    return $this->filter($singularFilter);
  }

  /**
   * Returns a subset containing plural forms only
   * 
   * @return PoFileIterator containing plural forms only
   */
  public function getPlurals(): PoFileIterator {
    $pluralFilter = function(Entry $entry) {
      return $entry->isPlural();
    };
    return $this->filter($pluralFilter);
  }

  /**
   * Returns a subset containing plural forms only
   * 
   * @return PoFileIterator containing plural forms only
   */
  public function filterByTranslation(string $needle): PoFileIterator {
    $filter = function(Entry $entry) use ($needle): bool {
      if ($entry->isPlural()) {
        $plurals = $entry->getMsgStrPlurals();
        //var_dump($plurals[0] === $needle || $plurals[1] === $needle);
        return mb_strpos($plurals[0], $needle) !== false ||  mb_strpos($plurals[1], $needle) !== false;
      } else {
        return mb_strpos($entry->getMsgStr(), $needle) !== false;
      }
    };
    return $this->filter($filter);
  }

  public function count(): int {
    return count($this->entries);
  }

  public function toArray(): array {
    return $this->entries;
  }

  public function getIterator(): Traversable {
    return new Collection($this->entries);
  }

  public static function parseFrom(string $poFilePath): PoFileIterator {
    $fileHandler = new FileSystem($poFilePath);
    $poParser = new Parser($fileHandler);
    $data = $poParser->parse();
    return new static($data);
  }

}
