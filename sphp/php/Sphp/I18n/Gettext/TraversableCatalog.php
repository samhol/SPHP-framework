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
class TraversableCatalog extends CatalogArray implements IteratorAggregate {

  /**
   * Constructor
   * 
   * @param Catalog|Entry[]|iterable $entries
   */
  public function __construct($entries = []) {
    if ($entries instanceof Catalog) {
      parent::__construct($entries->getEntries());
    } else if (is_array($entries)) {
      parent::__construct($entries);
    } else if (is_iterable($entries)) {
      parent::__construct(iterator_to_array($entries));
    }
    //print_r($entries);
  }

  public function sort(callable $cond): TraversableCatalog {
    $entries = $this->entries;
    usort($entries, $cond);
    return new static($entries);
  }

  /**
   * Filters components using the given callable
   * 
   * @param  callable $callback
   * @return TraversableCatalog a subset of objects
   */
  public function filter(callable $callback): TraversableCatalog {
    return new static(array_filter($this->entries, $callback, 0));
  }

  /**
   * Returns a subset containing singular forms only
   * 
   * @return TraversableCatalog containing singular forms only
   */
  public function getSingulars(): TraversableCatalog {
    $singularFilter = function(Entry $entry) {
      return !$entry->isPlural();
    };
    return $this->filter($singularFilter);
  }

  /**
   * Returns a subset containing plural forms only
   * 
   * @return TraversableCatalog containing plural forms only
   */
  public function getPlurals(): TraversableCatalog {
    $pluralFilter = function(Entry $entry) {
      return $entry->isPlural();
    };
    return $this->filter($pluralFilter);
  }

  /**
   * Returns a subset containing plural forms only
   * 
   * @return TraversableCatalog containing plural forms only
   */
  public function filterByTranslation(string $needle): TraversableCatalog {
    $filter = function(Entry $entry) use ($needle): bool {
      if ($entry->isPlural()) {
        $plurals = $entry->getMsgStrPlurals();
        //var_dump($plurals[0] === $needle || $plurals[1] === $needle);
        return mb_strpos($plurals[0], $needle) !== false || mb_strpos($plurals[1], $needle) !== false;
      } else {
        return mb_strpos($entry->getMsgStr(), $needle) !== false;
      }
    };
    return $this->filter($filter);
  }

  public function count(): int {
    return count($this->entries);
  }

  /**
   * 
   * @return Entry[]
   */
  public function toArray(): array {
    return $this->entries;
  }

  public function getIterator(): Traversable {
    return new Collection($this->entries);
  }

  public static function parseFrom(string $poFilePath): TraversableCatalog {
    $fileHandler = new FileSystem($poFilePath);
    $poParser = new Parser($fileHandler);
    $data = $poParser->parse();
    return new static($data);
  }

}
