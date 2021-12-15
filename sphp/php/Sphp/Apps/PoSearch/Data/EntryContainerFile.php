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

use Sphp\Apps\PoSearch\Data\PoEntryCollection;
use Countable;
use IteratorAggregate;

/**
 * Interface PoEntryContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class EntryContainerFile extends GettextFile implements Countable, IteratorAggregate {

  public function getEntryCollection(): PoEntryCollection {
    return PoEntryCollection::fromFile($this->getFileInfo()->getRealPath());
  }

  public function count(): int {
    return $this->getEntryCollection()->count();
  }

  public function getIterator(): PoEntryCollection {
    return $this->getEntryCollection();
  }

}
