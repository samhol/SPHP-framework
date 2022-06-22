<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch\Data;

use Sepia\PoParser\SourceHandler\FileSystem;
use Sepia\PoParser\Parser;
use Sepia\PoParser\Catalog\Entry;
use Iterator;
use Countable;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * The Controller class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PoEntryCollection implements Countable, Iterator, Arrayable {

  public const ANY_FORM = 0;
  public const SINGULARS = 1;
  public const PLURALS = 2;

  private bool $singulars = true;
  private bool $plurals = true;
  private ?string $idSeed = null;

  /**
   * 
   * @var Entry[]
   */
  private array $entries;

  public function __construct(array $entries) {
    $this->entries = $entries;
  }

  public function __destruct() {
    unset($this->entries);
  }

  public function searchSingulars(bool $search) {
    $this->singulars = $search;
    return $this;
  }

  public function searchPlurals(bool $search) {
    $this->plurals = $search;
    return $this;
  }

  public function searchIDsLike(?string $id) {
    $this->idSeed = $id;
    return $this;
  }

  public function isValid(Entry $e): bool {
    $valid = true;
    if (!$this->plurals && $e->isPlural() || !$this->singulars && !$e->isPlural()) {
      $valid = false;
    }
    if ($valid && $this->idSeed !== null) {
      $valid = str_contains($e->getMsgId(), $this->idSeed);
    }
    return $valid;
  }

  public function getPlurals(string $id = null): PoEntryCollection {
    $instance = clone $this;
    $instance->searchSingulars(false);
    $instance->searchIDsLike($id);
    return $instance->getEntries();
  }

  public function getSingulats(string $id = null): PoEntryCollection {
    $instance = clone $this;
    $instance->searchPlurals(false);
    $instance->searchIDsLike($id);
    return $instance->getEntries();
  }

  public function toArray(): array {
    $result = [];
    foreach ($this->entries as $hash => $e) {
      if ($this->isValid($e)) {
        $result[$hash] = $e;
      }
    }
    return $result;
  }

  public function getEntries(): PoEntryCollection {
    $result = [];
    foreach ($this->entries as $e) {
      if ($this->isValid($e)) {
        $result[] = $e;
      }
    }
    return new PoEntryCollection($this->toArray());
  }

  public function count(int $type = self::ANY_FORM): int {
    $count = 0;
    if ($type === self::ANY_FORM) {
      $count = count($this->entries);
    } else if ($type === self::PLURALS) {
      $count = count($this->getPlurals());
    } else if ($type === self::SINGULARS) {
      $count = count($this->getSingulats());
    }
    return $count;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current(): mixed {
    return current($this->entries);
  }

  /**
   * Advance the internal pointer of the collection
   *
   * @return void
   */
  public function next(): void {
    next($this->entries);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key(): mixed {
    return key($this->entries);
  }

  /**
   * Rewinds the Iterator to the first element
   *
   * @return void
   */
  public function rewind(): void {
    reset($this->entries);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return bool current if iterator position is valid
   */
  public function valid(): bool {
    return null !== key($this->entries);
  }

  public static function fromFile(string $path): PoEntryCollection {
    $poParser = new Parser(new FileSystem($path));
    $entries = $poParser->parse()->getEntries();
    return new PoEntryCollection($entries);
  }

}
