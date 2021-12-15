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

use Sepia\PoParser\Catalog\Entry;
use SplFileInfo;

/**
 * Class FileEntry
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FileEntry {

  private Entry $entry;
  private SplFileInfo $fileInfo;

  public function __construct(SplFileInfo $fileInfo, Entry $entry) {
    $this->fileInfo = $fileInfo;
    $this->entry = $entry;
  }

  public function __destruct() {
    unset($this->fileInfo, $this->entry);
  }

  public function __call(string $name, array $arguments) {
    
  }

  public function __clone() {
    $this->fileInfo = clone $this->fileInfo;
    $this->entry = clone $this->entry;
  }

  public function getFileInfo(): SplFileInfo {
    return $this->fileInfo;
  }

  public function getEntry(): Entry {
    return $this->entry;
  }

}
