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

use IteratorAggregate;
use Sphp\Stdlib\Datastructures\Arrayable;
use Countable;
use Sepia\PoParser\Catalog\Entry;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\BitMask;

/**
 * Class EntryFileFilter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EntryFileFilter implements IteratorAggregate, Arrayable, Countable {

  public const FUZZY = 0b1;
  public const SINGULAR = 0b10;
  public const PLURAL = 0b100;
  public const ALL_ENTRIES = 0b111;

  private EntryContainerFile $entryFile;
  private bool $singulars = true;
  private bool $plurals = true;
  private bool $fuzzy = true;
  private ?string $idSeed = null;
  private BitMask $bitmask;

  public function __construct(EntryContainerFile $entryFile, int $flags = self::ALL_ENTRIES) {
    $this->entryFile = $entryFile;
    $this->setFlags($flags);
  }

  public function setFlags(int $flags) {
    $this->bitmask = new BitMask($flags);
    //   var_dump($this->bitmask->contains($flags));
    if ($this->bitmask->contains(self::FUZZY)) {
      
    }
  }
  public function includeFuzzy(bool $include) {
    $this->bitmask->binXOR(self::SINGULAR);
    $this->fuzzy = $include;
    return $this;
  }

  public function searchSingulars(bool $search) {
    $this->bitmask->binXOR(self::SINGULAR);
    $this->singulars = $search;
    return $this;
  }

  public function searchPlurals(bool $search) {
    $this->bitmask->binAND(self::PLURAL);
    $this->plurals = $search;
    return $this;
  }

  public function searchIDsLike(?string $id) {
    $this->idSeed = $id;
    return $this;
  }

  public function accept(Entry $e): bool {
    if ($e->isPlural() && $this->bitmask->contains(self::PLURAL)) {
      // echo "is plural + ok\n";
    } else if (!$e->isPlural() && $this->bitmask->contains(self::SINGULAR)) {
      // echo "is singular + ok\n";
    } else {
      // echo "not ok\n";
    }
    $valid = $this->plurals && $e->isPlural() || $this->singulars && !$e->isPlural();

    if ($valid && $this->idSeed !== null) {
      $valid = $this->validateSeed($e);
    }
    return $valid;
  }

  public function validateSeed(Entry $e) {
    $valid = true;
    if ($this->idSeed !== null) {
      if ($e->isPlural()) {
        $valid = Strings::contains($e->getMsgId(), $this->idSeed) ||
                Strings::contains($e->getMsgIdPlural(), $this->idSeed);
      } else {
        $valid = Strings::contains($e->getMsgId(), $this->idSeed);
      }
    }
    return $valid;
  }

  public function toArray(): array {
    $result = [];
    foreach ($this->entryFile as $k => $e) {
      if ($this->accept($e)) {
        $result[$k] = $e;
      }
    }
    return $result;
  }

  public function getIterator(): PoEntryCollection {
    return new PoEntryCollection($this->toArray());
  }

  public function count(): int {
    return count($this->toArray());
  }

}
